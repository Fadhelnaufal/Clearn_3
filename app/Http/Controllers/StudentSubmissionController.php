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
        $submissions = $caseStudy->submissions()->where('student_id', Auth::user()->id)->get();
        return view('siswa.case-study', compact('caseStudy', 'submissions'));
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
        ]);

        // Redirect with success message
        return redirect()->back()
            ->with('success', 'Solution successfully submitted');
    }




}
