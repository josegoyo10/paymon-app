<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseUser;
use Illuminate\Http\Request;

class AdminCourseController extends Controller
{
    public function getRegisteredUsers($courseId)
    {
        $course = Course::with(['videos', 'registeredUsers.user', 'registeredUsers.currentVideo'])
            ->findOrFail($courseId);

        $usersData = $course->registeredUsers->map(function ($courseUser) {
            return [
                'user_id' => $courseUser->user->id,
                'user_name' => $courseUser->user->name,
                'current_video' => $courseUser->currentVideo ? $courseUser->currentVideo->title : null,
                'progress' => $courseUser->progress
            ];
        });

        return response()->json([
            'course' => $course->title,
            'users' => $usersData
        ]);
    }
}
