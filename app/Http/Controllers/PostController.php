<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $postData = $request->validate([
            'post_title' => ['required', 'string', 'max:255'],
            'post_body' => ['required', 'string'],
        ]);

        Post::create([
            'user_id' => $request->user()->getKey(),
            'title' => $postData['post_title'],
            'body' => $postData['post_body'],
        ]);

        return redirect()->route('dashboard');
    }
}
