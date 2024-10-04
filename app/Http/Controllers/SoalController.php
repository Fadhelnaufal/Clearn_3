<?php

namespace App\Http\Controllers;

use App\Models\JawabanSoalSiswa;
use App\Models\Kelas;
use App\Models\Materi;
use App\Models\OpsiPertanyaan;
use App\Models\PertanyaanSoal;
use App\Models\Soal;
use App\Models\SoalPertanyaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
    public function update(Request $request, $materi_id, $pertanyaan_id)
    {
        // dd($request->all());
        // Validate the incoming request data
        $request->validate([
            'pertanyaan_id'=>'required|integer|exists:pertanyaan_soals,id',
            'pertanyaan' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'jawaban' => 'required|array',
            'jawaban.*.opsi' => 'required|string',
            'jawaban.*.is_correct' => 'boolean',
        ]);

        // dd($request->all());

        $pertanyaan_id = $request->pertanyaan_id;
        // dd($pertanyaan_id);
        // Find the question and update its data
        $pertanyaan = PertanyaanSoal::findOrFail($pertanyaan_id);
        $pertanyaan->update([
            'pertanyaan' => $request->pertanyaan,
            'gambar' => $request->file('gambar') ? $request->file('gambar')->store('soal', 'public') : $pertanyaan->gambar,
        ]);

        // Delete existing answer options associated with the pertanyaan_id
        $pertanyaan->opsiPertanyaan()->delete(); // Assuming there is a relationship defined for jawaban in PertanyaanSoal model

        // Update answer options
        foreach ($request->jawaban as $jawaban) {
            OpsiPertanyaan::create([
                'pertanyaan_id' => $pertanyaan->id,
                'opsi' => $jawaban['opsi'],
                'is_correct' => isset($jawaban['is_correct']) ? 1 : 0,
            ]);
        }
        // dd($jawaban);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Soal berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $materi_id, string $soal_id)
    {
        // dd($soal_id);
        // Fetch all the related 'pertanyaan_id' records from 'SoalPertanyaan' using 'soal_id'
        $pertanyaans = SoalPertanyaan::where('soal_id', $soal_id)->get();
        // dd($pertanyaans,$soal_id);
        // Find the 'PertanyaanSoal' records with 'pertanyaan_id' from 'pertanyaans'
        $pertanyaanCollection = PertanyaanSoal::with('opsiPertanyaan')
            ->whereIn('id', $pertanyaans->pluck('pertanyaan_id'))
            ->get();

        // dd($pertanyaanCollection, $soal_id, $pertanyaans);
        // Loop through and delete each 'PertanyaanSoal' and its related 'opsiPertanyaan'
        foreach ($pertanyaanCollection as $pertanyaan) {
            // Delete related 'opsiPertanyaan' first
            $pertanyaan->opsiPertanyaan('pertanyaan_id')->delete();
            // Then delete the 'PertanyaanSoal'
            $pertanyaan->delete();
        }

        // Redirect back with success message
        return redirect()->back()->with('success', 'Pertanyaan and related options deleted successfully');
    }


    public function destroyPertanyaan(string $materi_id, string $soal_id, string $pertanyaan_id)
    {
        // dd($pertanyaan_id);
        // Find the 'PertanyaanSoal' record by the passed 'pertanyaan_id'
        $pertanyaan = PertanyaanSoal::with('opsiPertanyaan')->find($pertanyaan_id);

        if ($pertanyaan) {
            // Delete related 'opsiPertanyaan' first
            $pertanyaan->opsiPertanyaan()->delete();

            // Then delete the 'PertanyaanSoal'
            $pertanyaan->delete();

            // Redirect back with success message
            return redirect()->back()->with('success', 'Pertanyaan and related options deleted successfully');
        }

        // If the 'pertanyaan' is not found, return with error
        return redirect()->back()->with('error', 'Pertanyaan not found');
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

    public function showSoal($materi_id, $soalId)
    {
        $materi = Materi::with('soal')->findOrFail($materi_id);
        $soal = Soal::with('pertanyaanSoals')->find($soalId);
        $pertanyaans = SoalPertanyaan::where('soal_id', $soalId)->get();
        return view('siswa.soal', compact('soal', 'materi', 'pertanyaans'));
    }

    public function storeJawaban(Request $request)
    {
        // Debug data yang diterima untuk memastikan input benar
        // dd($request->all());

        // Validasi request
        $request->validate([
            'soal_id' => 'required|exists:soals,id',
            'jawaban' => 'required|json', // Memastikan jawaban dalam format JSON
            'pertanyaan_id' => 'required|array',
            'pertanyaan_id.*' => 'exists:pertanyaan_soals,id', // Memastikan setiap ID pertanyaan valid
        ]);

        // Dekode jawaban menjadi array
        $jawabanArray = json_decode($request->jawaban, true);

        // dd($jawabanArray);

        if (!$jawabanArray || !is_array($jawabanArray)) {
            return back()->withErrors(['jawaban' => 'Jawaban tidak valid.']);
        }

        // Dapatkan opsi terkait dari database
        $opsiIds = array_column($jawabanArray, 'opsi_id');
        $opsiDetails = OpsiPertanyaan::whereIn('id', $opsiIds)->get()->keyBy('id');

        // Mulai transaksi untuk memastikan semua jawaban disimpan dengan benar
        DB::beginTransaction();

        try {
            foreach ($jawabanArray as $jawabanDetail) {
                // Pastikan opsi yang dipilih valid
                if (!isset($opsiDetails[$jawabanDetail['opsi_id']])) {
                    throw new \Exception('Opsi yang dipilih tidak valid.');
                }

                // Ambil detail opsi
                $opsi = $opsiDetails[$jawabanDetail['opsi_id']];

                $isCorrect = $opsi->is_correct;

                // Simpan jawaban siswa ke database
                JawabanSoalSiswa::create([
                    'siswa_id' => $jawabanDetail['siswa_id'],
                    'soal_id' => $request->soal_id,
                    'pertanyaan_id' => $jawabanDetail['pertanyaan_id'],
                    'opsi_id' => $jawabanDetail['opsi_id'],
                    'is_correct' => $isCorrect, // Menyimpan status benar/salah dari opsi
                ]);
            }

            // Komit transaksi
            DB::commit();

            // Redirect ke halaman hasil soal dengan pesan sukses
            return redirect()->route('siswa.soal.hasil', ['materi_id' => $request->materi_id, 'soalId' => $request->soal_id])
                            ->with('success', 'Jawaban berhasil disimpan!');
        
        } catch (\Exception $e) {
            // Rollback transaksi jika ada error
            DB::rollBack();
            return back()->withErrors(['jawaban' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function hasilSoal($soalId, $materi_id)
    {
        $materi = Materi::with('soal')->findOrFail($materi_id);
        $soal = Soal::findOrFail($soalId);
        $jawabanSiswas = JawabanSoalSiswa::where('soal_id', $soalId)->get();
        return view('siswa.preview-soal', compact('materi', 'soal', 'jawabanSiswas'));
    }
}
