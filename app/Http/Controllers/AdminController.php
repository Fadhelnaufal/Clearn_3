<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswaCount = User::role('siswa')->count(); // Get the count of users with the 'siswa' role
        $guruCount = User::role('guru')->count(); // Get the count of users with the 'guru' role
        $userCount = User::count(); // Get the count of all users
        $adminCount = User::role('admin')->count(); // Get the count of users with the 'admin' role
        return view('admin.dashboard' , compact('siswaCount', 'guruCount', 'userCount','adminCount'));
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
        //
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
