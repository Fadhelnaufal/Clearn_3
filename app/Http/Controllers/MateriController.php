<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materi;
use App\Models\Kelas;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materi = Materi::get()->all();
        return view('class.materi', compact('materi'));
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
            'judul' => 'required|max:255',
        ]);

        $data = $request->only(['judul']);

        $kelas = Kelas::findOrFail($request->kelas_id);
        $materi = $kelas->materi()->create($data);

        return redirect()->route('kelas.show', $request->kelas_id)
            ->with('success', 'Materi berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $materi = Materi::findOrFail($id);

        return view('materi.edit', compact('materi'));
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

        return redirect()->route('kelas.show', $materi->kelas_id)
            ->with('success', 'Materi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $materi = Materi::findOrFail($id);

        $materi->delete();

        return redirect()->route('kelas.show', $materi->kelas_id)
            ->with('success', 'Materi berhasil dihapus');
    }
}
