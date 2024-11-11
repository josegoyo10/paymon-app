<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class CreateCourse extends Component
{
    public $title;
    public $description;
    public $category_id;
    public $age_group;
    public $categories = []; // Lista de categoría

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'category_id' => 'required',
        'age_group' => 'required|in:5-8,9-13,14-16,16+',
    ];

    public function mount()
    {
        // Simulación de obtener categorías (puedes obtenerlas desde un API o la BD)
        $this->categories = [
            ['id' => 1, 'name' => 'Matemáticas'],
            ['id' => 2, 'name' => 'Ciencia'],
            ['id' => 3, 'name' => 'Arte'],
            ['id' => 4, 'name' => 'Tecnologia'],

        ];
    }

    public function createCourse()
    {
        $this->validate();

        try {
            // Llamada a la API para crear el curso
            //dd("llego aca");
            $response = Http::post(route('api.courses.store'), [
                'title' => $this->title,
                'description' => $this->description,
                'category_id' => $this->category_id,
                'age_group' => $this->age_group,
            ]);

            //dd("respuesta...:".$response->successful());
            if ($response) {
                session()->flash('message', 'Curso creado exitosamente.');
                $this->reset();
            } else {
                session()->flash('error', 'Error al crear el curso: ' . $response->json('message'));
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Ocurrió un error: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.create-course');
    }
}
