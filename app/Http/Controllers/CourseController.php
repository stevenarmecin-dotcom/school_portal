<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $courseData = $request->validate([
            'course_title' => ['required', 'string', 'max:255'],
        ]);

        Course::create([
            'title' => $courseData['course_title'],
        ]);

        return redirect()->route('dashboard');
    }
}
