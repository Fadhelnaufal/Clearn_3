<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::get()->all();
        return view('index', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('class.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'mapel' => 'required|max:255',
            'kelas' => 'required|max:255',
            'logo' => 'required|image|mimes:jpg,jpeg,png,gif|max:4098',
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('images/logos', $fileName, 'public');
            $request->merge(['logo' => $filePath]);
        }

        $data = $request->all();
        $data['guru_id'] = Auth::user()->id;
        $data['token'] = Str::random(5); // Automatically generate a 64-character token

        $kelas = Kelas::create($data);

        return redirect()->route('kelas.show', $kelas->id)
            ->with('success', 'Kelas Berhasil dibuat dengan token: ' . $kelas->token);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('class.show', compact('kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('class.edit', compact('kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'mapel' => 'required|max:255',
            'kelas' => 'required|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:4098',
        ]);

        $kelas = Kelas::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('logo')) {
            // Hapus file logo lama jika ada
            if ($kelas->logo) {
                Storage::disk('public')->delete($kelas->logo);
            }

            $file = $request->file('logo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('images/logos', $fileName, 'public');
            $data['logo'] = $filePath;
        }

        $kelas->update($data);

        return redirect()->route('kelas.show', $kelas->id)
            ->with('success', 'Kelas berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kelas = Kelas::findOrFail($id);

        // Hapus file logo jika ada
        if ($kelas->logo) {
            Storage::disk('public')->delete($kelas->logo);
        }

        $kelas->delete();

        return redirect()->route('kelas.index')
            ->with('success', 'Kelas berhasil dihapus');
    }
}
