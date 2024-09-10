<?php

namespace App\Http\Controllers;
use App\Models\UserType;

use Illuminate\Http\Request;

class UserTypeController extends Controller
{
    public function showForm()
    {
        // Fetch user types or a specific user type
        $userTypes = UserType::all(); // or use find() if you need a specific user type

        return view('guru.tambah_materi', compact('userTypes'));
    }
}
