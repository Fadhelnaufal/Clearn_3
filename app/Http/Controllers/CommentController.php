<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $discussionId)
    {
        $this->validate($request, [
            'content' => 'required',
        ]);

        $discussion = Discussion::findOrFail($discussionId);

        Comment::create([
            'discussion_id' => $discussionId,
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return redirect()->route('discussions.show', [$discussion->kelas_id, $discussionId])
                         ->with('success', 'Comment added successfully.');
    }
}
