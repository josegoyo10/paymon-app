<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class VideoCurso extends Component
{
    public $courseId;
    public $userId;
    public $videos = [];

    public function mount($courseId)
    {
        $this->courseId = $courseId;
        $this->userId = Auth::user()->id;
        $this->loadVideos();
    }

    public function loadVideos(){
        $response = Http::get(route('api.courses.videos', ['course' => $this->courseId]));

        if ($response) {
            $this->videos = $response->json('videos');
        }

    }

    public function render()
    {
        return view('livewire.video-curso');
    }
}
