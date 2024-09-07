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
        return view('livecode');
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

    public function store(Request $request, $caseStudyId)
    {
        $this->validate($request, [
            'html' => 'nullable|string',
            'css' => 'nullable|string',
            'javascript' => 'nullable|string',
        ]);

        $caseStudy = CaseStudies::findOrFail($caseStudyId);

        // Ensure the student is enrolled in the class
        if (!Auth::user()->kelas->contains('id', $caseStudy->kelas_id)) {
            return redirect()->back()->with('error', 'You are not enrolled in the class for this case study.');
        }

        StudiesSubmission::create([
            'case_study_id' => $caseStudyId,
            'student_id' => Auth::user()->id,
            'html' => $request->input('html'),
            'css' => $request->input('css'),
            'javascript' => $request->input('javascript'),
        ]);

        return redirect()->route('case_studies.index')
            ->with('success', 'Solution successfully submitted');
    }
}
