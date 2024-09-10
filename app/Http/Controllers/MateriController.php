<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materi;
use App\Models\Kelas;
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

        $view = $user->hasRole('guru') ? 'guru.course_detail_guru' : 'siswa.course_detail';
        return view($view, compact('materi'));
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
        $kelas = Kelas::findOrFail($id); // Assuming you have a Kelas model
        // $materi = Materi::get()->all();
        $materis = $kelas->materi()->with('subMateris')->get();;
        if ($materis === null) {
            return abort(404, 'Materis not found');
        }

        $materi = $materis->first();

        $user = Auth::user();
        $view = $user->hasRole('guru') ? 'guru.course_detail_guru' : 'siswa.course_detail';

        return view($view, compact('kelas', 'materi', 'materis'));

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
