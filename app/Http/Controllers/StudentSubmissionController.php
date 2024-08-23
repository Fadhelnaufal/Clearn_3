<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentSubmissionController extends Controller
{
    public function create($id)
    {
        $caseStudy = CaseStudy::findOrFail($id);

        // Ensure the student is enrolled in the class
        $studentClasses = auth()->user()->enrolledClasses()->pluck('id')->toArray();
        if (!in_array($caseStudy->kelas_id, $studentClasses)) {
            return redirect()->back()->with('error', 'You are not enrolled in the class for this case study.');
        }

        return view('student_submissions.create', compact('caseStudy'));
    }

    public function store(Request $request, $caseStudyId)
    {
        $this->validate($request, [
            'html' => 'nullable|string',
            'css' => 'nullable|string',
            'javascript' => 'nullable|string',
        ]);

        $caseStudy = CaseStudy::findOrFail($caseStudyId);

        // Ensure the student is enrolled in the class
        $studentClasses = auth()->user()->enrolledClasses()->pluck('id')->toArray();
        if (!in_array($caseStudy->kelas_id, $studentClasses)) {
            return redirect()->back()->with('error', 'You are not enrolled in the class for this case study.');
        }

        StudentSubmission::create([
            'case_study_id' => $caseStudyId,
            'student_id' => auth()->user()->id,
            'html' => $request->input('html'),
            'css' => $request->input('css'),
            'javascript' => $request->input('javascript'),
        ]);

        return redirect()->route('case_studies.index')
            ->with('success', 'Solution successfully submitted');
    }
}
