<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kelas;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $kelas = Kelas::where('user_id', $user->id)->get();
        // dd($kelas);
        return view('guru.dashboard_guru', compact('kelas'));
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
        $kelas = Kelas::findOrFail($id);
        return view('guru.dashboard_guru', compact('kelas'));    }

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

    public function compiler()
    {
        return view('compiler.compiler');
    }
    public function quiz()
    {
        return view('guru.quiz');
    }
    public function tambah_quiz()
    {
        return view('guru.tambah-quiz');
    }
    public function detail_quiz()
    {
        return view('guru.detail-quiz');
    }
}
