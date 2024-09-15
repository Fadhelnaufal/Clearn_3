<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudiesSubmission;
class ResultCaseStudyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $submission = StudiesSubmission::with('users')->get();
        return view('guru.hasil-studi-kasus', compact('submission'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $caseStudy = CaseStudies::findOrFail($id);
        $submissions = $caseStudy->submissions()->where('student_id', Auth::user()->id)->get();
        return view('guru.hasil-studi-kasus', compact('caseStudy', 'submissions'));
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
