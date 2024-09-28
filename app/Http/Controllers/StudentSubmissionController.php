<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CaseStudies;
use App\Models\StudiesSubmission;
use Illuminate\Support\Facades\Auth;

class StudentSubmissionController extends Controller
{
    public function index()
    {
        $caseStudies = CaseStudies::all();
        return view('siswa.case-study' , compact('caseStudies'));
    }

    public function show($id)
    {
        $caseStudy = CaseStudies::findOrFail($id);
        $submission = $caseStudy->submissions()->where('student_id', Auth::user()->id)->first();

        return view('siswa.case-study', compact('caseStudy', 'submission'));
    }

    public function create($id)
    {
        $caseStudy = CaseStudies::findOrFail($id);

        // Check if the student is enrolled using the relationship
        if (!Auth::user()->kelas->contains('id', $caseStudy->kelas_id)) {
            return redirect()->back()->with('error', 'You are not enrolled in the class for this case study.');
        }

        return view('student_submissions.create', compact('caseStudy'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'html' => 'nullable|string',
            'css' => 'nullable|string',
            'js' => 'nullable|string',
            'case_study_id' => 'required|integer|exists:case_studies,id',
        ]);

        // Retrieve the case study
        $caseStudyId = $request->input('case_study_id');
        $caseStudy = CaseStudies::findOrFail($caseStudyId);


        // Ensure the student is enrolled in the class
        if (!Auth::user()->kelas->contains('id', $caseStudy->kelas_id)) {
            return redirect()->back()->with('error', 'You are not enrolled in the class for this case study.');
        }

        // Create a new submission record
        $submission = StudiesSubmission::create([
            'case_study_id' => $caseStudyId,
            'student_id' => Auth::user()->id,
            'html' => $request->input('html'),
            'css' => $request->input('css'),
            'js' => $request->input('js'),
            'is_submitted' => true,
            'completed_at' => now(),
        ]);

        $user = Auth::user();
        $subMateriId = $caseStudyId;

        $userTask = \App\Models\UserTask::firstOrCreate(
            [
                'student_id' => $user->id,
                'task_id' => $subMateriId, // Set the task ID from case study ID or subMateri
                'task_type' => 'case_study', // Ensure this matches your task type logic
                'user_type_id' => $user->user_type_id, // Add user type ID
            ],
            [
                'is_completed' => false, // Set task as completed after submission
                'completed_at' => null, // Mark the completion time
            ]
        );
        $userTask->save();

        // Redirect with success message
        return redirect()->back()
            ->with('success', 'Solution successfully submitted');
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'html' => 'nullable|string',
            'css' => 'nullable|string',
            'js' => 'nullable|string',
            'case_study_id' => 'required|integer|exists:case_studies,id',
        ]);

        // Retrieve the case study and the existing submission
        $caseStudyId = $request->input('case_study_id');
        $caseStudy = CaseStudies::findOrFail($caseStudyId);
        $submission = StudiesSubmission::where('case_study_id', $caseStudyId)
            ->where('student_id', Auth::user()->id)
            ->firstOrFail(); // Make sure to get the submission for the current student

        // Ensure the student is enrolled in the class
        if (!Auth::user()->kelas->contains('id', $caseStudy->kelas_id)) {
            return redirect()->back()->with('error', 'You are not enrolled in the class for this case study.');
        }

        // Update the submission with the validated data
        $submission->update([
            'html' => $request->input('html'),
            'css' => $request->input('css'),
            'js' => $request->input('js'),
            'is_submitted' => true, // Assuming you want to keep this true on update as well
            'completed_at' => now(), // Update completed_at time if needed
        ]);

        return redirect()->back()->with('success', 'Submission updated successfully');
    }

}
