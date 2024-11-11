<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use App\Models\Course;
use App\Models\Category;

class CreateVideo extends Component
{
    public $title;
    public $youtube_url;
    public $description;
    public $course_id;
    public $category_id;
    public $courses = []; 
    public $categories= []; 

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'youtube_url' => 'required',
        'course_id' => 'required|exists:courses,id',
        'category_id' => 'required',

    ];

    public function mount()
    {
       
        $this->courses = Course::all();
        $this->categories = Category::all();
    }

    public function createVideo()
    {
        $this->validate();

        try {
            // Llamada a la API para crear el video

            $response = Http::post(route('api.videos.store'), [
                'course_id'     => $this->course_id,
                'title'         => $this->title,
                'description' => $this->description,
                'youtube_url' => $this->youtube_url,
                'category_id' => $this->category_id,
            ]);

            if ($response) {
                session()->flash('message', 'Video creado exitosamente.');
                $this->reset(['title', 'description', 'course_id','youtube_url','category_id']);
            } else {
                session()->flash('error', 'Error al crear el video: ' . $response->json('message'));
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Ocurrió un error: ' . $e->getMessage());
        }
    }


    public function render()
    {
        return view('livewire.admin.create-video');
    }
}
