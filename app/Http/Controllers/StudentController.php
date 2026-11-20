<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $studentData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        Student::create($studentData);

        return redirect()->route('dashboard');
    }
}
