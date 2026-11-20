<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post): RedirectResponse
    {
        $field = 'comment_body_'.$post->getKey();
        $commentData = $request->validate([
            $field => ['required', 'string'],
        ]);

        $post->comments()->create([
            'body' => $commentData[$field],
        ]);

        return redirect()->route('dashboard');
    }
}
