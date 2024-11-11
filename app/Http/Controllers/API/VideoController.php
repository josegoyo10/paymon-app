<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\Course;
use App\Models\User;
use App\Models\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;

class VideoController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'youtube_url' => 'required|url',
            'course_id' => 'required|exists:courses,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $video = Video::create($request->all());

        return response()->json(['message' => 'Video creado exitosamente', 'video' => $video], 201);
    }

    public function getCourseVideos(Request $request, Course $course)
    {
        $user =  Auth::user();

        // Obtener los videos del curso
        $videos = $course->videos()->get();

        return response()->json(['videos' => $videos], 200);
    }
}
