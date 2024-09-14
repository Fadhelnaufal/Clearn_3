<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CkeditorController extends Controller
{
    public function index()
    {
        return view('guru.tambah_materi');
    }

    public function upload(Request $request)
    {

        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $originName = $file->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $file->move(public_path('media'), $fileName);

            $url = asset('media/' . $fileName);
            return response()->json(['filename' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }

        return response()->json(['upload' => 0]);
    }
}
