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
    public function index(Request $request)
    {
        // Assuming you want to filter by case_study_id
        $caseStudyId = $request->query('case_study_id', null);
        $caseStudy = CaseStudies::find($caseStudyId);
        $kelasId = $caseStudy ? $caseStudy->kelas_id : null;
        
        $submission = StudiesSubmission::with(['users', 'user_tasks', 'nilai_case_studies'])->where('case_study_id', $caseStudyId)->get();

        foreach ($submission as $submissions) {
            if ($submissions->nilai_case_studies) {
                // If nilai_case_studies exists, calculate the average score
                $submissions->average_score = $submissions->nilai_case_studies->total / 5;
                $submissions->score_message = $submissions->nilai_case_studies->total/5; // Keep the total score
            } else {
                // If there's no related nilai_case_studies, set average_score to null
                $submissions->average_score = null; 
                $submissions->score_message = 'Belum Dinilai'; // Default message
            }
        }

        return view('guru.hasil-studi-kasus', compact('submission', 'caseStudyId', 'caseStudy', 'kelasId'));
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
            'student_id' => $submission->student_id,
            'kategori_1' => $request->input('kategori_1'),
            'kategori_2' => $request->input('kategori_2'),
            'kategori_3' => $request->input('kategori_3'),
            'kategori_4' => $request->input('kategori_4'),
            'kategori_5' => $request->input('kategori_5'),
            'total' => $total, // Use the calculated total
        ];

        $nilai = NilaiCaseStudy::updateOrCreate(
            [
                'case_study_id' => $caseStudyId,
                'student_id' => $submission->student_id,
            ],
            $data
        );

        $nilai->save();

        // Calculate average points
        $averagePoints = $total / 5;

        // Create or update the UserTask record
        $userTask = UserTask::updateOrCreate(
            [
                'student_id' => $submission->student_id, // Match based on student_id
                'task_id' => $caseStudyId, // Match based on task_id (case study ID)
            ],
            [
                'task_type' => 'case_study', // Specify the task type if it's being set
                'is_completed' => true, // Mark it as completed
                'completed_at' => now(), // Set the completion time
                'points' => $averagePoints, // Store the average points
            ]
        );

        return redirect()->back()->with('success', 'Nilai case study updated successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $caseStudy = CaseStudies::findOrFail($id);
        $submissions = $caseStudy->submissions()->where('student_id', Auth::user()->id)->get();
        $kelasId = $caseStudy->kelas_id;
        return view('guru.hasil-studi-kasus', compact('caseStudy', 'submissions', 'kelasId'));
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
        // dd($caseStudyId,$id);
        $caseStudy = CaseStudies::findOrFail($caseStudyId);
        $submission = StudiesSubmission::with(['caseStudy', 'user_tasks', 'nilai_case_studies']) // Add user_tasks if needed
        ->where('student_id', $id)
        ->firstOrFail();
        return view('guru.lihat-studi-kasus', compact('submission', 'caseStudy'));
    }
}
