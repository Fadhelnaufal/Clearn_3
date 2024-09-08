<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Models\Materi;
use App\Models\SubMateri;
use Illuminate\Support\Facades\Storage;

class SubMateriController extends Controller
{
    // ... existing methods
    public function showSubMateri($id, $subMateriId)
    {
        $kelas = Kelas::findOrFail($id);
        $materis = $kelas->materi; // Ensure this relationship exists and returns a collection of materi
        $subMateri = SubMateri::findOrFail($subMateriId);

        return view('materi.show_sub_materi', compact('subMateri', 'materis'));
    }

    // Show form to create a new sub materi
    public function createSubMateri($materiId)
    {
        $materi = Materi::findOrFail($materiId);
        return view('materi.create_sub_materi', compact('materi'));
    }

    // Store a new sub materi
    public function storeSubMateri(Request $request, $materiId)
    {
        $this->validate($request, [
            'judul' => 'required|max:255',
            'isi' => 'required',
            'lampiran' => 'nullable|file|mimes:pdf,doc,docx|max:10000',
        ]);

        $materi = Materi::findOrFail($materiId);

        $data = $request->only(['judul', 'isi']);

        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('files/sub_materi', $fileName, 'public');
            $data['lampiran'] = $filePath;
        }

        $materi->subMateris()->create($data);

        return redirect()->route('materi.show', $materiId)
            ->with('success', 'Sub Materi berhasil ditambahkan');
    }

    // Show form to edit a sub materi
    public function editSubMateri($subMateriId)
    {
        $subMateri = SubMateri::findOrFail($subMateriId);
        return view('materi.edit_sub_materi', compact('subMateri'));
    }

    // Update an existing sub materi
    public function updateSubMateri(Request $request, $subMateriId)
    {
        $this->validate($request, [
            'judul' => 'required|max:255',
            'isi' => 'required',
            'lampiran' => 'nullable|file|mimes:pdf,doc,docx|max:10000',
        ]);

        $subMateri = SubMateri::findOrFail($subMateriId);
        $data = $request->only(['judul', 'isi']);

        if ($request->hasFile('lampiran')) {
            // Delete old file if exists
            if ($subMateri->lampiran) {
                Storage::disk('public')->delete($subMateri->lampiran);
            }

            $file = $request->file('lampiran');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('files/sub_materi', $fileName, 'public');
            $data['lampiran'] = $filePath;
        }

        $subMateri->update($data);

        return redirect()->route('materi.show', $subMateri->materi_id)
            ->with('success', 'Sub Materi berhasil diperbarui');
    }

    // Delete a sub materi
    public function destroySubMateri($subMateriId)
    {
        $subMateri = SubMateri::findOrFail($subMateriId);

        // Delete file if exists
        if ($subMateri->lampiran) {
            Storage::disk('public')->delete($subMateri->lampiran);
        }

        $materiId = $subMateri->materi_id;
        $subMateri->delete();

        return redirect()->route('materi.show', $materiId)
            ->with('success', 'Sub Materi berhasil dihapus');
    }
}
