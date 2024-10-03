<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Materi;
use App\Models\OpsiPertanyaan;
use App\Models\PertanyaanSoal;
use App\Models\Soal;
use App\Models\SoalPertanyaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($materi_id, $soal_id)
    {
        // Find the materi and eager load the associated soals
        $materi = Materi::with('soal')->findOrFail($materi_id);
        $soals = $materi->soal;
        $soal = Soal::findOrFail($soal_id);
        $pertanyaans = SoalPertanyaan::where('soal_id', $soal_id)->get();
        $jawabans = PertanyaanSoal::with('opsiPertanyaan')->whereIn('id', $pertanyaans->pluck('pertanyaan_id'))->get();

        return view('guru.tambah-soal', compact('materi', 'soals', 'soal', 'pertanyaans', 'jawabans'));
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
        $this->validate($request, [
            'nama' => 'required|max:255',
        ]);

        $data = $request->only(['nama']);
        $materi = Materi::findOrFail($request->materi_id);
        $soal = Soal::create([
            'nama' => $data['nama'],
            'materi_id' => $materi->id,
        ]);


        $kelas = Kelas::findOrFail($materi->kelas_id);

        return redirect()->route('guru.course-detail.show', $kelas->id)
            ->with('success', 'Soal berhasil ditambahkan');
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
        // Find the existing question (PertanyaanSoal) by its ID
        $pertanyaanSoal = PertanyaanSoal::findOrFail($id);

        // Validate the input data
        $this->validate($request, [
            'pertanyaan' => 'required',
            'jawaban.*.opsi' => 'required', // Validate each answer option
            'jawaban.*.is_correct' => 'boolean', // Validate the correctness checkbox
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:4096',
        ]);

        // dd($request->all());

        // Retain the current image path if not updating
        $filePath = $pertanyaanSoal->gambar;

        // Check if a new image file is uploaded
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar'); // Get the uploaded file
            // Generate a random file name
            $fileName = str()->random(10) . '.' . $gambar->getClientOriginalExtension();
            // Store the file in the specified path
            $gambar->move(public_path('assets/images/soal'), $fileName);
            $filePath = $fileName;
        }

        // Update the PertanyaanSoal record
        $pertanyaanSoal->update([
            'pertanyaan' => $request->pertanyaan,
            'gambar' => $filePath, // Update image if applicable
        ]);

        // dd($pertanyaanSoal,$id);

        // Ensure you have the soal_id available
        $soal_id = $request->soal_id; // Assuming soal_id is available in the request

        // dd($soal_id);
        // Find the associated SoalPertanyaan record
        $pertanyaanId = 2;
        $pertanyaan = PertanyaanSoal::findOrFail($pertanyaanId);
        $soalPertanyaan = SoalPertanyaan::where('pertanyaan_id', $pertanyaan->id)->firstOrFail();

        dd($soalPertanyaan,$id);
        // If SoalPertanyaan does not exist, create it
        if (!$soalPertanyaan) {
            SoalPertanyaan::create([
                'pertanyaan_id' => $pertanyaanSoal->id,
                'soal_id' => $soal_id,
            ]);
        }

        // Delete the existing options (jawaban) based on pertanyaan_id
        OpsiPertanyaan::where('pertanyaan_id', $pertanyaanSoal->id)->delete();
        // dd($request->jawaban);
        // Save each answer option (jawaban)
        foreach ($request->jawaban as $jawaban) {
            OpsiPertanyaan::create([
                'opsi' => $jawaban['opsi'],
                'is_correct' => isset($jawaban['is_correct']) ? 1 : 0, // Save as 1 if checkbox is checked
                'pertanyaan_id' => $pertanyaanSoal->id, // Link to the updated question
            ]);
        }

        // dd($request->all());

        // Log successful update
        Log::info('Pertanyaan updated successfully:', ['pertanyaan_id' => $pertanyaanSoal->id]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Soal berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function storePertanyaan(Request $request, $materi_id, $soal)
    {
        $soal=Soal::findOrFail($soal);
        $soal_id = $soal->id;
        // Validate the input data
        $this->validate($request, [
            'pertanyaan' => 'required',
            'jawaban.*.opsi' => 'required', // Validate each answer option
            'jawaban.*.is_correct' => 'nullable', // Validate if correct
            'gambar'=>'nullable|image|mimes:jpg,jpeg,png,gif|max:4098',
        ]);

        $filePath = null; // Initialize the variable for the file path

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar'); // Get the uploaded file
            // Generate a random file name
            $fileName = str()->random(10) . '.' . $gambar->getClientOriginalExtension();
            // Store the file in the specified path
            $gambar->move(public_path('assets/images/soal'), $fileName);
            $filePath = $fileName;
        }

        // dd($filePath,$request);

        // Create the question (PertanyaanSoal)
        $pertanyaanSoal = PertanyaanSoal::create([
            'pertanyaan' => $request->pertanyaan,
            'gambar' => $filePath, // Handle image upload
        ]);        $soal = SoalPertanyaan::create([
            'pertanyaan_id' => $pertanyaanSoal->id,
            'soal_id' => $soal_id,
        ]);        // Save each answer option (jawaban)
        foreach ($request->jawaban as $jawaban) {
            OpsiPertanyaan::create([
                'opsi' => $jawaban['opsi'],
                'is_correct' => isset($jawaban['is_correct']) ? 1 : 0, // Save as 1 if checkbox is checked
                'pertanyaan_id' => $pertanyaanSoal->id, // Link to the created question
            ]);
        }

        return redirect()->back()->with('success', 'Soal berhasil ditambahkan');
    }

}
