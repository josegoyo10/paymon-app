<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Http;

use Livewire\Component;

class MyCourseRegistration extends Component
{
    public $userId;
    public $courses = [];

    public function mount($userId)
    {
        $this->userId = $userId;
        $this->myCourse();
    }

    public function myCourse()
    {
        $response = Http::post(route('api.courses.mycourse', ['user' =>  $this->userId]));


        if ($response) {
            $this->courses = $response->json('courses');
        } else {
            $this->courses = [];
            session()->flash('error', 'No se encontraron resultados.');
        }
    }

    public function render()
    {
        return view('livewire.my-course-registration');
    }
}
