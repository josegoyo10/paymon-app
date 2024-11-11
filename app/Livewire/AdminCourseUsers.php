<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class AdminCourseUsers extends Component
{
    public $courseId;
    public $courseData;
    public $users = [];

    public function mount($courseId)
    {
        $this->courseId = $courseId;
        $this->loadUsersData();
    }

    public function loadUsersData()
    {
        $response = Http::get(route('api.admin.courses.users', ['courseId' => $this->courseId]));

        $this->courseData = $response->json('course');
        $this->users = $response->json('users');
    }

    public function render()
    {
        return view('livewire.admin-course-users');
    }
}
