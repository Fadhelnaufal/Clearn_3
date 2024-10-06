<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Materi;
use App\Models\SubMateri;
use App\Models\UserTask;
use App\Models\UserType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Str;

class SubMateriController extends Controller
{
    // ... existing methods
    public function showSubMateri($id, $materiId, $subMateriId, $userTypeId = null)
    {
        // Fetch the Kelas instance
        $kelas = Kelas::with(['materi', 'case_studies', 'users'])->findOrFail($id);

        // Fetch the specific Materi and SubMateri
        $materi = Materi::where('id', $materiId)->where('kelas_id', $id)->firstOrFail();
        $subMateri = SubMateri::where('id', $subMateriId)->where('materi_id', $materiId)->firstOrFail();

        // Fetch the other necessary data
        $userTypes = UserType::all();
        $case_studies = $kelas->case_studies;
        $siswas = $kelas->users()->whereHas('roles', function ($query) {
            $query->where('role_id', 3); // Adjust role_id as needed
        })->get();

        // Determine the view based on the user's role
        $user = Auth::user();
        $case = $user->kelas;
        $task = UserTask::where('student_id', $user->id)
        ->where('task_id', $subMateriId)
        ->where('task_type', 'sub_materi')
        ->first();

        $subMateri->is_completed = $task ? $task->is_completed : false;
        $view = $user->hasRole('guru') ? 'guru.preview-materi' : 'siswa.materi';

        // Return the view with all necessary data
        return view($view, compact('kelas', 'materi', 'subMateri', 'userTypeId', 'case_studies', 'siswas', 'userTypes', 'task'));
    }

    // Show form to create a new sub materi
    public function createSubMateri($kelasId, $materiId)
    {
        // dd('a');

        $kelas = Kelas::with('materi')->find($kelasId);
        $materi = Materi::findOrFail($materiId);
        $userTypes = UserType::all();
        return view('guru.tambah_materi', compact('kelas', 'materi', 'userTypes'));
    }

    // Store a new sub materi
    public function storeSubMateri(Request $request, $userTypeId)
    {

        $all_data = json_decode($request->all_form);


        foreach ($all_data as $key => $value) {
            $all_data = json_decode($request->all_form);
            // dd($all_data);
            $lampiran = $request->file('lampiran');

            foreach ($all_data as $key => $value) {
                // dd($value);

                $data = [
                    'judul' => $value->judul,
                    'isi' => $value->isi, // Get the correct 'isi' field
                    'materi_id' => $value->materi_id,
                    'user_type_id' => $value->id_kategori, // Assuming 'kategori_id' is the same as 'user_type_id'
            ];

            // dd($data);
            if (isset($lampiran[$key])) {
                $fileName = str()->random(10) . '.' . $lampiran[$key]->getClientOriginalExtension();
                $filePath = $lampiran[$key]->storeAs('files/sub_materi', $fileName, 'public');
                $lampiran[$key]->move(public_path('files/sub_materi'), $fileName);
                $data['lampiran'] = $fileName;
            }

            SubMateri::create($data);
        }

            // if (isset($value->lampiran)) {
            //     $file = $request->file('lampiran');
            //     $fileName = time() . '_' . $file->getClientOriginalName();
            //     $filePath = $file->storeAs('files/sub_materi', $fileName, 'public');
            //     $data['lampiran'] = $filePath;
            // }



            // if ($value['lampiran']) {
            //     $file = $request->file('lampiran');
            //     $fileName = time() . '_' . $file->getClientOriginalName();
            //     $filePath = $file->storeAs('files/sub_materi', $fileName, 'public');
            //     $data['lampiran'] = $filePath;
            // }



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
        // return redirect()->route('guru.dashboard')
        //     ->with('success', 'Sub Materi berhasil ditambahkan');
        return response()->json(['success' => 'Sub materi created successfully']);

        }
    }


    // Show form to edit a sub materi
    public function editSubMateri($kelasId, $materiId, $subMateriId, $userTypeId)
    {
        $kelas = Kelas::with(['materi', 'case_studies', 'users'])->findOrFail($kelasId);
        $userTypes = UserType::all();
        $materi = Materi::findOrFail($materiId);
        $subMateri = SubMateri::where('id', $subMateriId)->where('materi_id', $materiId)->firstOrFail();

        return view('guru.edit_materi', compact('kelas','materi','materiId', 'subMateri' , 'userTypeId', 'userTypes'));
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

        // Delete attached file if it exists
        if ($subMateri->lampiran && Storage::disk('public')->exists($subMateri->lampiran)) {
            Storage::disk('public')->delete($subMateri->lampiran);
        }

        $subMateri->userTasks()->delete();
        // Delete the sub-materi record
        $subMateri->delete();

        // Redirect to the course or specific class page if necessary
        return redirect()->route('course.index')
            ->with('success', 'Sub Materi berhasil dihapus');
    }

    public function markAsRead(Request $request, $kelasId, $materiId, $subMateriId)
{
    $request->validate([
        'kelas_id' => 'required|integer',
        'materi_id' => 'required|integer',
    ]);

    // dd($request->all());

    $user = Auth::user();
    $kelasId = $request->input('kelas_id');
    $materiId = $request->input('materi_id');

    // dd($kelasId, $materiId);
    // Find or create the user task
    // Validasi kelas_id
    try {
        $kelas = Kelas::findOrFail($kelasId);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json(['error' => 'Kelas tidak ditemukan!'], 404);
    }
    try {
        $userTask = UserTask::firstOrCreate(
            [
                'kelas_id' => $kelasId,
                'materi_id' => $materiId,
                'student_id' => $user->id,
                'task_id' => $subMateriId,
                'task_type' => 'sub_materi',
                'user_type_id' => $user->user_type_id,
            ],
            [
                'is_completed' => true,
                'completed_at' => Carbon::now(),
                'points' => 50,
            ]
        );
        return response()->json(['success' => 'Materi sudah dibaca']);
    } catch (\Exception $e) {
        // Log the error message
        \Log::error('Error marking subMateri as read: ' . $e->getMessage());
        return response()->json(['error' => 'Terjadi kesalahan saat memproses permintaan!'], 500);
    }
}


}
