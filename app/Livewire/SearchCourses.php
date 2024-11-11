<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Http;
use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class SearchCourses extends Component
{
    public $age_group;
    public $category;
    public $name;
    public $courses = [];
    public $categories= []; 
    public $userId;

    protected $rules = [
        'age_group' => 'nullable|string',
        'category' => 'nullable|string',
        'name' => 'nullable|string',
    ];

    public function mount()
    {
       
        $this->categories = Category::all();
        $this->userId = Auth::user()->id;
    }

    public function search()
    {
        $this->validate();
    // Hacer la petición a la API
    try {
        // $response = Http::withToken(auth()->user()->currentAccessToken()->plainTextToken)
        //     ->get(route('api.courses.search'), [
        //         'age_group' => $this->age_group,
        //         'category' => $this->category,
        //         'name' => $this->name,
        //     ]);
       // dd("llego search");
        $response = Http::get(route('api.courses.search'), [
            'age_group' => $this->age_group,
            'category' => $this->category,
             'name' => $this->name,
        ]);

        if ($response) {
            $this->courses = $response->json('courses');
        } else {
            $this->courses = [];
            session()->flash('error', 'No se encontraron resultados.');
        }
    } catch (\Exception $e) {
        session()->flash('error', 'Ocurrió un error al buscar los cursos.');
    }
    }

    public function render()
    {
        return view('livewire.search-courses');
    }
}
