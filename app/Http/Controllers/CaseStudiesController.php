<?php

namespace App\Http\Controllers;

use App\Models\CaseStudies;
use App\Models\Kelas;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CaseStudiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('siswa')) {
            $case = $user->kelas; // Ensure this relationship exists in your User model
        } else {
            $materi = Materi::all();
        }

        $view = $user->hasRole('guru') ? 'guru.course_detail_guru' : 'siswa.course_detail';
        return view($view, compact('case'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('materi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required|max:1000',
            'image'=> 'nullable|image|mimes:jpg,jpeg,png,gif|max:4098',
        ]);
        $fileName = null;

        if($request->hasFile('image')){
            $file = $request->file('image');
            $originName = $file->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileName = time(). '_' . $fileName  . '.' . $extension;
            $file->move(public_path('assets/images/case_studies'), $fileName);
        }

        $data = $request->all();
        
        if ($fileName) {
            $data['image'] = $fileName;
        }
        $kelas = Kelas::findOrFail($request->kelas_id);
        $caseStudy = $kelas->case_studies()->create($data);

        return redirect()->route('guru.course-detail.show', $kelas->id)->with('success', 'Studi Kasus berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kelas = Kelas::finfOrdFail($id);
        $materis = $kelas->materi()->with('livecode')->get();
        if ($materis === null) {
            return abort(404, 'case not found');
        }

        $user = Auth::user();
        $materi = $materis->first();
        $view = $user->hasRole('guru') ? 'guru.course_detail_guru' : 'siswa.course_detail';

        return view($view, compact('kelas', 'materi', 'materis'));
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
            'title' => 'required|max:255',
            'description' => 'required|max:1000',
        ]);

        $caseStudy = CaseStudies::findOrFail($id);
        $data = $request->only('title','description');

        $caseStudy->update($data);

        return redirect()->route('guru.course-detail.show', $caseStudy->kelas_id)->with('success', 'Studi Kasus berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $caseStudy = CaseStudies::findOrFail($id);
        $caseStudy->delete();

        return redirect()->back()->with('success', 'Studi Kasus berhasil dihapus');
    }
}
