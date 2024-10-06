<?php

namespace App\Http\Controllers;

use App\Models\CaseStudies;
use App\Models\NilaiCaseStudy;
use Illuminate\Http\Request;
use App\Models\StudiesSubmission;
use App\Models\UserTask;
use Carbon\Carbon;
use Illuminate\Container\Attributes\Log;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class ResultCaseStudyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($caseStudyId)
{
    // Ambil studi kasus berdasarkan ID
    $caseStudy = CaseStudies::findOrFail($caseStudyId);
    $kelasId = $caseStudy->kelas_id;

    // Ambil semua pengajuan berdasarkan case_study_id
    $submissions = StudiesSubmission::with(['user', 'nilai_case_studies'])
        ->where('case_study_id', $caseStudyId)
        ->where('is_submitted', true)
        ->get();
    

    foreach ($submissions as $submission) {
        // Cek jika ada nilai_case_studies terkait
        if ($submission->nilai_case_studies) {
            // Jika ada, hitung nilai rata-rata
            $submission->average_score = $submission->nilai_case_studies->total / 5;
            $submission->score_message = $submission->nilai_case_studies->total; // Menyimpan total nilai
        } else {
            // Jika tidak ada, set nilai rata-rata menjadi null
            $submission->average_score = null; 
            $submission->score_message = 'Belum Dinilai'; // Pesan default
        }
    }

    // Kembalikan view dengan data yang telah diolah
    return view('guru.hasil-studi-kasus', compact('submissions', 'caseStudyId', 'caseStudy', 'kelasId'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'case_study_id' => 'required',
            'student_id' => 'nullable|numeric',
            'kategori_1' => 'nullable|numeric',
            'kategori_2' => 'nullable|numeric',
            'kategori_3' => 'nullable|numeric',
            'kategori_4' => 'nullable|numeric',
            'kategori_5' => 'nullable|numeric',
            'total' => 'nullable|numeric',
        ]);
        // dd($request->all());

        $total = $request->input('kategori_1', 0) +
         $request->input('kategori_2', 0) +
         $request->input('kategori_3', 0) +
         $request->input('kategori_4', 0) +
         $request->input('kategori_5', 0);

        $caseStudyId = $request->input('case_study_id');
        $studentId = $request->input('student_id');

        $submission = StudiesSubmission::where('case_study_id', $caseStudyId)
            ->where('student_id', $studentId)
            ->first();

        if (!$submission) {
            return redirect()->back()->with('error', 'Submission not found');
        }

        $data = [
            'case_study_id' => $caseStudyId,
            'student_id' => $studentId,
            'kategori_1' => $request->input('kategori_1'),
            'kategori_2' => $request->input('kategori_2'),
            'kategori_3' => $request->input('kategori_3'),
            'kategori_4' => $request->input('kategori_4'),
            'kategori_5' => $request->input('kategori_5'),
            'total' => $total, // Use the calculated total
        ];

        // dd($data);

        $nilai = NilaiCaseStudy::updateOrCreate(
            [
                'case_study_id' => $caseStudyId,
                'student_id' => $studentId,
            ],
            $data
        );
        // dd($nilai);
        $nilai->save();

        // Calculate average points
        $averagePoints = $total / 5;
        // dd($averagePoints);
        // Create or update the UserTask record
        $userTask = UserTask::updateOrCreate(
            [
                'kelas_id' => $submission->caseStudy->kelas_id, // Match based on kelas_id
                'materi_id' =>null,
                'student_id' => $studentId, // Match based on student_id
                'task_id' => $caseStudyId, // Match based on task_id (case study ID)
                'task_type' => 'case_study', // Specify the task type if it's being set
            ],
            [
                'is_completed' => true, // Mark it as completed
                'completed_at' => now(), // Set the completion time
                'points' => $averagePoints, // Store the average points
            ]
        );
        // dd($userTask);

        return redirect()->back()->with('success', 'Nilai case study updated successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($caseStudyId)
{
    // Ambil case study berdasarkan ID
    $caseStudy = CaseStudies::findOrFail($caseStudyId);

    // Ambil semua submission untuk case_study_id tersebut
    $submissions = StudiesSubmission::with(['users', 'nilai_case_studies'])
        ->where('case_study_id', $caseStudyId)
        // ->where('student_id', Auth::user()->id)
        ->get();

    // Proses data submissions untuk menghitung nilai jika sudah dinilai
    foreach ($submissions as $submission) {
        // Load the nilai_case_studies based on the student_id and case_study_id
        $nilaiCaseStudy = NilaiCaseStudy::where('student_id', $submission->student_id)
            ->where('case_study_id', $caseStudyId)
            ->first();
        
        if ($nilaiCaseStudy) {
            $submission->average_score = $nilaiCaseStudy->total / 5;
        } else {
            $submission->average_score = 'Belum Dinilai';
        }
    }

    // dd($submission->average_score);

    // Kembalikan view dengan data caseStudy dan submissions
    return view('guru.hasil-studi-kasus', compact('submissions', 'caseStudy'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $student_id)
    {
        // Validate the input data
        $this->validate($request, [
            'kategori_1' => 'nullable|numeric',
            'kategori_2' => 'nullable|numeric',
            'kategori_3' => 'nullable|numeric',
            'kategori_4' => 'nullable|numeric',
            'kategori_5' => 'nullable|numeric',
        ]);

        // Calculate the total score from the categories
        $total = $request->input('kategori_1', 0) +
                $request->input('kategori_2', 0) +
                $request->input('kategori_3', 0) +
                $request->input('kategori_4', 0) +
                $request->input('kategori_5', 0);

        // Find the existing record of NilaiCaseStudy by case_study_id and student_id
        $nilai = NilaiCaseStudy::where('case_study_id', $request->input('case_study_id'))
                    ->where('student_id', $student_id)
                    ->first();

        // Check if the record exists
        if ($nilai) {
            // Update the existing record with new category values and total score
            $nilai->update([
                'kategori_1' => $request->input('kategori_1', 0),
                'kategori_2' => $request->input('kategori_2', 0),
                'kategori_3' => $request->input('kategori_3', 0),
                'kategori_4' => $request->input('kategori_4', 0),
                'kategori_5' => $request->input('kategori_5', 0),
                'total' => $total,
            ]);

            // Redirect back with success message
            return redirect()->back()->with('success', 'Nilai case study updated successfully.');
        }

        // If no record is found, return with an error message
        return redirect()->back()->with('error', 'Nilai case study not found.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function showSubmission(string $caseStudyId, $id)
{
    // Ambil case study berdasarkan ID
    $caseStudy = CaseStudies::findOrFail($caseStudyId);

    // Ambil submission berdasarkan student_id dan case_study_id
    $submission = StudiesSubmission::with(['caseStudy', 'user_tasks', 'nilai_case_studies'])
        ->where('student_id', $id)
        ->where('case_study_id', $caseStudyId)
        ->firstOrFail();

    // Ambil nilai berdasarkan student_id dan case_study_id
    $nilai_case_studies = NilaiCaseStudy::where('case_study_id', $caseStudyId)
        ->where('student_id', $id)
        ->first();

    return view('guru.lihat-studi-kasus', compact('submission', 'caseStudy', 'nilai_case_studies'));
}

}
