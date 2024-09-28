<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckClassAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $kelasId = $request->route('kelasId');
        $user = Auth::user();

        // Check if the user is a student and has been removed from the class
        if ($user->hasRole('siswa')) {
            $kelas = $user->kelas()->find($kelasId);

            if (!$kelas) {
                // If student no longer has access to the class, redirect
                return redirect()->route('siswa.course.index')->with('error', 'Kamu dikeluarkan dari Kelas.');
            }
        }

        return $next($request);
    }
}
