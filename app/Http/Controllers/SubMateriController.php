<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Materi;
use App\Models\SubMateri;
use App\Models\UserType;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SubMateriController extends Controller
{
    // ... existing methods
    public function showSubMateri($id, $subMateriId, $userTypeId)
{
    // Fetch the Kelas instance with its related Materis and Case Studies
    $kelas = Kelas::with(['materi', 'case_studies', 'users'])->findOrFail($id);

    // Fetch all user types
    $userTypes = UserType::all();

    // Check if Materis exists; initialize as an empty collection if null
    $materis = $kelas->materi ?? collect();

    // Fetch case studies related to the Kelas
    $case_studies = $kelas->case_studies;

    // Fetch users with role 'siswa' (role_id 3); adjust if necessary
    $siswas = $kelas->users()->whereHas('roles', function ($query) {
        $query->where('role_id', 3); // Adjust role_id based on your application's role setup
    })->get();

    // Determine the view based on the user's role
    $user = Auth::user();
    $view = $user->hasRole('guru') ? 'guru.preview-materi' : 'siswa.materi';

    // Return the appropriate view with the data
    return view($view, compact('kelas', 'materis', 'userTypes', 'case_studies', 'siswas'));
}


    // Show form to create a new sub materi
    public function createSubMateri($materiId, $kelasId)
    {
        $kelas = Kelas::with('materi')->find($kelasId);
        // $materi = Materi::findOrFail($materiId);
        // $userType = UserType::findOrFail($userTypeId);
        return view('materi.create_sub_materi', compact('kelas', 'materi'));
    }

    // Store a new sub materi
    public function storeSubMateri(Request $request, $userTypeId)
    {
        // dd($request->all());


        $all_data = json_decode($request->all_form);


        foreach ($all_data as $key => $value) {
            // dd($value);
            $data = [
                'judul' => $value->judul,
                'isi' => $value->isi, // Get the correct 'isi' field
                'user_type_id' => $value->id_kategori, // Assuming 'kategori_id' is the same as 'user_type_id'
                'materi_id' => $value->materi_id,
            ];

            // if (isset($value->lampiran)) {
            //     $file = $request->file('lampiran');
            //     $fileName = time() . '_' . $file->getClientOriginalName();
            //     $filePath = $file->storeAs('files/sub_materi', $fileName, 'public');
            //     $data['lampiran'] = $filePath;
            // }

            SubMateri::create($data);

            // if ($value['lampiran']) {
            //     $file = $request->file('lampiran');
            //     $fileName = time() . '_' . $file->getClientOriginalName();
            //     $filePath = $file->storeAs('files/sub_materi', $fileName, 'public');
            //     $data['lampiran'] = $filePath;
            // }
        }


        // Adjust validation rules
        // $validationRules = [
        //     'judul' => 'required|max:255',
        //     'materi_id' => 'required|integer',
        //     'user_type_id' => 'required|integer',
        //     'isi.' . $userTypeId => 'required|string', // Dynamic validation for 'isi'
        //     'lampiran' => 'nullable|file|mimes:pdf,doc,docx|max:10000',
        // ];

        // // Perform validation
        // $validatedData = $request->validate($validationRules);

        // // Collecting data for saving
        // $data = [
        //     'judul' => $validatedData['judul'],
        //     'isi' => $validatedData['isi'][$userTypeId], // Get the correct 'isi' field
        //     'kategori_id' => $userTypeId, // Assuming 'kategori_id' is the same as 'user_type_id'
        //     'materi_id' => $validatedData['materi_id'],
        // ];

        // Handle file upload if present
        // if ($request->hasFile('lampiran')) {
        //     $file = $request->file('lampiran');
        //     $fileName = time() . '_' . $file->getClientOriginalName();
        //     $filePath = $file->storeAs('files/sub_materi', $fileName, 'public');
        //     $data['lampiran'] = $filePath;
        // }

        // Create the sub-materi record in the database
        // SubMateri::create($data);

        // Redirect back with a success message
        return redirect()->route('guru.dashboard')
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
