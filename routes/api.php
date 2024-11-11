<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\API\VideoController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\LikeController;

Route::post('/register', [UserController::class, 'store'])->name('api.register');
Route::post('/courses', [CourseController::class, 'store'])->name('api.courses.store');
Route::post('/videos', [VideoController::class, 'store'])->name('api.videos.store');
Route::get('/courses/search', [CourseController::class, 'search'])->name('api.courses.search');
Route::post('/courses/{course}/{user}/register', [CourseController::class, 'registerUser'])->name('api.courses.register');

Route::get('/courses/{course}/videos', [VideoController::class, 'getCourseVideos'])->name('api.courses.videos');
Route::post('/mycourse/{user}', [CourseController::class, 'index'])->name('api.courses.mycourse');

Route::post('/videos/{video}/comments', [CommentController::class, 'store'])->name('api.comments.store');;
Route::get('/videos/{video}', [CommentController::class, 'index'])->name('api.videos.comments');
Route::post('/videos/{video}/like', [LikeController::class, 'like'])->name('api.videos.like');

// Route::middleware('auth:sanctum')->group(function () {
//    // Route::post('/courses', [CourseController::class, 'store'])->name('api.courses.store');
// });
