<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class UserCreateModal extends Component
{
    
    public $isOpen = false;
    public $name;
    public $email;
    public $password;
    public $role = 'user';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8',
        'role' => 'required|in:admin,user',
    ];

    protected $listeners = ['openModal' => 'showModal'];

    public function showModal()
    {
        $this->resetForm();
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function resetForm()
    {
        $this->reset(['name', 'email', 'password', 'role']);
    }

    public function createUser()
    {
        $this->validate();

        try {
            // Realizar llamada a la API para crear usuario
            $response = Http::post(route('api.register'), [
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password,
                'role' => $this->role,
            ]);

            if ($response->successful()) {
                session()->flash('message', 'Usuario creado exitosamente.');
                $this->closeModal();
            } else {
                session()->flash('error', 'Error al crear usuario: ' . $response->json('message'));
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Error en la conexión con el servidor.');
        }
    }

    public function render()
    {
        return view('livewire.user-create-modal');
    }
}