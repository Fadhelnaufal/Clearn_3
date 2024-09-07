<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Discussion;
use Illuminate\Support\Facades\Auth;

class DiscussionController extends Controller
{
    public function index($kelasId)
    {
        $kelas = Kelas::findOrFail($kelasId);
        $discussions = Discussion::where('kelas_id', $kelasId)->get();

        return view('discussions.index', compact('kelas', 'discussions'));
    }

    public function create($kelasId)
    {
        $kelas = Kelas::findOrFail($kelasId);
        return view('discussions.create', compact('kelas'));
    }

    public function store(Request $request, $kelasId)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        Discussion::create([
            'kelas_id' => $kelasId,
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('discussions.index', $kelasId)
                         ->with('success', 'Discussion created successfully.');
    }

    public function show($kelasId, $discussionId)
    {
        $discussion = Discussion::where('kelas_id', $kelasId)->findOrFail($discussionId);
        return view('discussions.show', compact('discussion'));
    }
}
