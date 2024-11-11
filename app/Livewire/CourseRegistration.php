<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CourseRegistration extends Component
{
    public $courseId;
    public $userId;
    public $videos = [];
    public $currentVideo;
    public $isRegistered = false;

    public function mount($courseId, $userId)
    {
        $this->courseId = $courseId;
        $this->userId = $userId;
        //$this->checkRegistration();
    }

      // Verificar si el usuario ya está registrado en el curso
      public function checkRegistration()
      {
        //   $response = Http::withToken(auth()->user()->currentAccessToken()->plainTextToken)
        //       ->post(route('api.courses.register', ['course' => $this->courseId]));
        
        $response = Http::get(route('api.courses.register'), [
            $this->courseId,
            $this->userId
        ]);

          if ($response) {
              $this->isRegistered = true;
              $this->loadVideos();
          }
      }

      // Registrar al usuario en el curso
    public function register()
    {
        $response = Http::post(route('api.courses.register', ['course' => $this->courseId,'user' =>  $this->userId]));

        if ($response) {
            $this->isRegistered = true;
            $this->loadVideos();
            session()->flash('message', 'Te has registrado en el curso exitosamente.');
        } else {
            session()->flash('error', 'No se pudo registrar en el curso.');
        }
    }

    

    // Cargar videos del curso
    public function loadVideos()
    {
        
        $response = Http::get(route('api.courses.videos', ['course' => $this->courseId]));

        if ($response) {
            $this->videos = $response->json('videos');
            $this->currentVideo = $this->videos[0] ?? null;
        }
    }

    // Seleccionar video para ver
    public function selectVideo($videoId)
    {
        $this->currentVideo = collect($this->videos)->firstWhere('id', $videoId);
    }

    public function render()
    {
        return view('livewire.course-registration');
    }
}
