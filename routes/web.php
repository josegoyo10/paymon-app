<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\UserCreate;
use App\Livewire\Admin\CreateCourse;
use App\Livewire\Admin\CreateVideo;
use App\Livewire\SearchCourses;
use App\Livewire\CourseRegistration;
use App\Livewire\MyCourseRegistration;
use App\Livewire\VideoCurso;
use App\Livewire\VideoInteraction;

Route::get('/', function () {
    //return view('welcome');
    return view('frontend.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/add-user', UserCreate::class)->name('add-user');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/create-course', CreateCourse::class)->name('create-course');
    Route::get('/create-video', CreateVideo::class)->name('create-video');
    Route::get('/buscar-curso', SearchCourses::class)->name('buscar-curso');
    Route::get('/courses/{courseId}/{userId}/register', CourseRegistration::class)->name('registrarse-curso');
    Route::get('/cursos-registrados/{userId}', MyCourseRegistration::class)->name('cursos-registrados');
    Route::get('/video-curso/{courseId}', VideoCurso::class)->name('video-curso');
    Route::get('/add-comment/{videoId}', VideoInteraction::class)->name('add-comment-video');

});

require __DIR__ . '/auth.php';