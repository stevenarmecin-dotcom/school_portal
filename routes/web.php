<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserPhoneController;
use App\Models\Course;
use App\Models\Post;
use App\Models\Student;
use App\Models\UserPhone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', fn () => view('login'))->name('home');

Route::view('login', 'login')->name('login');

Route::post('login', LoginController::class)
    ->middleware('throttle:5,1')
    ->name('login.attempt');

Route::get('dashboard', function () {
    return view('dashboard', [
        'posts' => Post::with('user')
            ->withCount('comments')
            ->with(['comments' => fn ($query) => $query->latest()->limit(3)])
            ->latest()
            ->get(),
        'courses' => Course::withCount('students')->orderBy('title')->get(),
        'students' => Student::with('courses')->orderBy('name')->get(),
        'userPhones' => UserPhone::with('phones')->orderBy('name')->get(),
    ]);
})->middleware('auth')->name('dashboard');

Route::post('dashboard/students', [StudentController::class, 'store'])
    ->middleware('auth')
    ->name('students.store');

Route::post('dashboard/posts', [PostController::class, 'store'])
    ->middleware('auth')
    ->name('posts.store');

Route::post('dashboard/posts/{post}/comments', [CommentController::class, 'store'])
    ->middleware('auth')
    ->name('comments.store');

Route::post('dashboard/courses', [CourseController::class, 'store'])
    ->middleware('auth')
    ->name('courses.store');

Route::post('dashboard/phone-records', [UserPhoneController::class, 'store'])
    ->middleware('auth')
    ->name('phone-records.store');

Route::post('logout', function () {
    Auth::guard('web')->logout();

    Session::invalidate();
    Session::regenerateToken();

    return redirect()->route('login');
})->name('logout');

Route::view('register', 'register')->name('register');

Route::post('register', RegisterController::class)->name('register.store');
