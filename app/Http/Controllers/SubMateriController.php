<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Materi;
use App\Models\SubMateri;
use App\Models\UserType;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class SubMateriController extends Controller
{
    // ... existing methods
    public function showSubMateri($id, $subMateriId)
    {
        $kelas = Kelas::with('materi')->findOrFail($id);
        $userTypes = UserType::all();
        $materis = $kelas->materis; // Use the correct relationship here
        // $subMateri = SubMateri::findOrFail($subMateriId);
        // $subMateri = null;

        return view('guru.tambah_materi', compact('kelas', 'materis', 'userTypes'));
    }

    // Show form to create a new sub materi
    public function createSubMateri($materiId,$kelasId)
    {
        $kelas = Kelas::findOrFail($kelasId);
        $materi = Materi::findOrFail($materiId);
        // $userType = UserType::findOrFail($userTypeId);
        return view('materi.create_sub_materi', compact('kelas','materi'));
    }

    // Store a new sub materi
    public function storeSubMateri(Request $request, $userTypeId, $kelasId, $materiId)
    {
        $this->validate($request, [
            'judul' => 'required|max:255',
            'isi' => 'required',
            'lampiran' => 'nullable|file|mimes:pdf,doc,docx|max:10000',
        ]);

        $kelas = Kelas::findOrFail($kelasId);
        $materi = Materi::findOrFail($materiId);
        $userType = UserType::findOrFail($userTypeId);

        $data = $request->only(['judul', 'isi']);
        $data['kategori_id'] = $userTypeId;

        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('files/sub_materi', $fileName, 'public');
            $data['lampiran'] = $filePath;
        }

        $materi = $kelas->materis()->first();
        // $materi->subMateris()->create($data);
        if ($materi) {
            $materi->subMateris()->create($data);
        } else {
            // If no Materi is found, directly create SubMateri in Kelas
            $kelas->subMateris()->create($data);
        }

        return redirect()->route('guru-course-detail.show', $kelasId)
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
