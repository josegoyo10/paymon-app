<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseUser extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'course_id', 'current_video_id', 'progress'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function currentVideo()
    {
        return $this->belongsTo(Video::class, 'current_video_id');
    }
}
