<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;

class SettingRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::role(['guru', 'siswa'])->get();
        $roles = Role::all();
        return view('admin.setting-role', compact('users', 'roles'));
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
        // Validate the request
        $this$request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|integer'
        ]);

        // Map the role id to role name
        $roles = [
            1 => 'admin',
            2 => 'guru',
            3 => 'siswa',
            4 => 'guest'
        ];

        // Check if the role exists in the roles array
        if (!array_key_exists($request->role, $roles)) {
            return redirect()->back()->withErrors(['role' => 'Invalid role selected']);
        }

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Assign the role to the new user
        $user->assignRole($roles[$request->role]);

        // Log any errors (if needed)
        \Illuminate\Support\Facades\Log::error('An error occurred', ['error' => $exception ?? null]);

        // Redirect with success message
        return redirect()->route('admin.setting-role.index')->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();
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
        $user = User::findOrFail($id);

        // Validate the input data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'role' => 'required|string'
        ]);

        // Update the user details
        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        // Sync roles
        $user->syncRoles([$request->role]);

        return redirect()->route('setting-role.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Delete the user
        $user->delete();

        return redirect()->route('setting-role.index')->with('success', 'User deleted successfully');
    }
}
