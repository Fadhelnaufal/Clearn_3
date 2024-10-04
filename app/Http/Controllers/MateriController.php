<?php

namespace App\Http\Controllers;

use App\Models\CaseStudies;
use Illuminate\Http\Request;
use App\Models\Materi;
use App\Models\Kelas;
use App\Models\SubMateri;
use App\Models\SoalTest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('siswa')) {
            // Fetch classes the user has joined (assuming the relationship name is 'kelas')
            $materi = $user->kelas; // Ensure this relationship exists in your User model
        } else {
            // For 'guru' or other roles, fetch all classes
            $materi = Materi::all();
        }

        $kelas = Kelas::all();
        $view = $user->hasRole('guru') ? 'guru.course_detail_guru' : 'siswa.course_detail';
        return view($view, compact('kelas','materi'));
        // $materi = Materi::get()->all();
        // return view('guru.materi', compact('materi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('materi.create');
    }
    public function show($id)
{
    // Retrieve the course details based on the ID
    $kelas = Kelas::findOrFail($id); 
    $user = Auth::user()->load('user_tasks');
    $totalPoints = $user->user_tasks->sum('points');

    // Retrieve materis based on user role
    if ($user->hasRole('siswa')) {
        // For 'siswa', filter subMateris based on user_type_id
        $materis = $kelas->materi()->with(['subMateris' => function($query) use ($user) {
            $query->where('user_type_id', $user->user_type_id); // Filter for siswa
        }])->get();
    } else {
        // For 'guru', retrieve all materis with all subMateris
        $materis = $kelas->materi()->with('subMateris')->get();
    }

    // Initialize total subMateris and completed tasks counters
    $totalSubMateris = 0;
    $completedSubMateris = 0;

    // Prepare completion status for all subMateris and count them
    foreach ($materis as $materi) {
        $subMateris = $materi->subMateris;

        // Count the total subMateris
        $totalSubMateris += $subMateris->count();

        // Check completion status for each subMateri
        foreach ($subMateris as $subMateri) {
            // Check if the task type for the subMateri is completed
            $subMateri->is_completed = $user->user_tasks()->where('task_type', 'sub_materi')->where('task_id', $subMateri->id)->exists();
            if ($subMateri->is_completed) {
                $completedSubMateris++;
            }
        }
    }

    // Retrieve case studies and soal tests related to the kelas
    $case_studies = $kelas->case_studies()->get();
    $soalTests = $kelas->materi()->with('soal')->get();

    // Calculate total challenges (subMateris, case_studies, soalTests)
    $totalCaseStudies = $case_studies->count();
    $totalSoalTests = $soalTests->pluck('soal')->flatten()->count();
    $totalChallenges = $totalSubMateris + $totalCaseStudies + $totalSoalTests;

    // Count completed tasks for case studies and soal tests based on task_type
    $completedCaseStudies = $user->user_tasks()
        ->where('task_type', 'case_study')
        ->where('is_completed', true)
        ->count();

    $completedSoalTests = $user->user_tasks()
        ->where('task_type', 'soal')
        ->where('is_completed', true)
        ->count();

    // Sum up completed challenges
    $completedChallenges = $completedSubMateris + $completedCaseStudies + $completedSoalTests;

    // Retrieve all students in the class
    $siswas = $kelas->users()->whereHas('roles', function ($query) {
        $query->where('role_id', 3); // Assuming role_id 3 is for 'siswa'
    })->get();

    // Determine which view to use based on the user's role
    $view = $user->hasRole('guru') ? 'guru.course_detail_guru' : 'siswa.course_detail';

    return view($view, compact(
        'user', 'siswas', 'kelas', 'materis', 
        'case_studies', 'soalTests', 'totalPoints', 
        'totalChallenges', 'completedChallenges', 
        'totalSubMateris', 'completedSubMateris', 
        'totalCaseStudies', 'completedCaseStudies', 
        'totalSoalTests', 'completedSoalTests'
    ));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required|max:255',
        ]);

        $data = $request->only(['judul']);

        $kelas = Kelas::findOrFail($request->kelas_id);
        $materi = $kelas->materi()->create($data);

        return redirect()->route('guru.course-detail.show', $request->kelas_id)
            ->with('success', 'Materi berhasil ditambahkan');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $materi = Materi::findOrFail($id);
        $kelas = Kelas::findOrFail($materi->kelas_id);

        if (is_null($materi)) {
            abort(404, 'Materi not found');
        }

        return view('guru.course-detail', compact('materi', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'judul' => 'required|max:255'
        ]);

        $materi = Materi::findOrFail($id);
        $data = $request->only(['judul']);


        $materi->update($data);

        return redirect()->route('guru.course-detail.show', $materi->kelas_id)
            ->with('success', 'Materi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $materi = Materi::findOrFail($id);

        $materi->delete();

        return redirect()->route('guru.course-detail.show', $materi->kelas_id)
            ->with('success', 'Materi berhasil dihapus');


    }
}
