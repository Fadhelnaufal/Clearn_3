<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('siswa')) {
            // Fetch classes the user has joined (assuming the relationship name is 'kelas')
            $kelas = $user->kelas; // Ensure this relationship exists in your User model
        } else {
            // For 'guru' or other roles, fetch all classes
            $kelas = Kelas::all();
        }

        $view = $user->hasRole('guru') ? 'guru.course_guru' : 'siswa.course';
        return view($view, compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('course.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'mapel' => 'required|max:255',
            'kelas' => 'required|max:255',
            'logo' => 'required|image|mimes:jpg,jpeg,png,gif|max:4098',
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $originName = $file->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileName = time(). '_' . $fileName  . '.' . $extension;
            $file->move(public_path('assets/images/logos'), $fileName);
        }

        $data = $request->all();
        $data['logo'] = $fileName;
        $data['user_id'] = Auth::user()->id;
        $data['token'] = Str::random(5); // Automatically generate a 64-character token

        $kelas = Kelas::create($data);

        return redirect()->route('course.index', $kelas->id)
            ->with('success', 'Kelas "' . $kelas->mapel . '" berhasil dibuat dengan token: ' . $kelas->token);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kelas = Kelas::with('user')->get();

        return redirect()->route('course.index', $kelas->id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('course.edit', compact('kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'mapel' => 'required|max:255',
            'kelas' => 'required|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:4098',
        ]);

        $kelas = Kelas::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('logo')) {
            // Hapus file logo lama jika ada
            if ($kelas->logo) {
                Storage::disk('public')->delete($kelas->logo);
            }

            $file = $request->file('logo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('images/logos', $fileName, 'public');
            $request->merge(['logo' => $filePath]);
        }

        $kelas->update($data);

        return redirect()->route('course.show', $kelas->id)
            ->with('success', 'Kelas berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);

        // Hapus file logo jika ada
        if ($kelas->logo) {
            Storage::disk('public')->delete($kelas->logo);
        }

        $kelas->delete();

        return redirect()->route('course.index')
            ->with('success', 'Kelas berhasil dihapus');
    }

    public function join(Request $request)
    {
        // Validate the request token
        $this->validate($request, [
            'token' => 'required|exists:kelas,token', // Validate that the token exists in the `kelas` table
        ]);

        // Retrieve the currently authenticated user
        $user = Auth::user();

        // Find the class using the token
        $kelas = Kelas::where('token', $request->input('token'))->firstOrFail();

        // Check if the user is already joined
        if ($user->kelas->contains($kelas)) {
            return redirect()->back()->with('error', 'Anda sudah bergabung dengan kelas ini.');
        }

        // Attach the class to the user
        $user->kelas()->attach($kelas->id);

        return redirect()->route('siswa.course.index')->with('success', 'Berhasil bergabung dengan kelas.');
    }

    public function destroyJoin($id)
    {
        $user = Auth::user();

        // Find the class by ID
        $kelas = Kelas::findOrFail($id);

        // Detach the user from the class
        if ($user->kelas->contains($kelas)) {
            // Detach the class from the user
            $user->kelas()->detach($kelas->id);
            return redirect()->route('siswa.course.index')->with('success', 'Anda telah keluar dari kelas.');
        }

        return redirect()->route('siswa.course.index')->with('error', 'Anda tidak tergabung dalam kelas ini.');
    }
    public function cetakSertifikat($kelasId)
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Fetch the class (Kelas) based on the provided ID
        $kelas = Kelas::findOrFail($kelasId);

        // Prepare the data to pass to the view for generating the certificate
        $data = [
            'name' => $user->name,        // User's name
            'kelas_name' => $kelas->mapel, // Class/course name
            'date' => now()->format('d M Y'), // Current date
        ];

        // Generate the PDF using the certificate template
        $pdf = Pdf::loadView('template.sertif-template', $data)
            ->setPaper('A4', 'landscape');

        // Stream the PDF to the browser instead of downloading it
        return $pdf->stream($user->name . '.pdf');
    }



}
