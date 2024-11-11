<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Http;

class UserCreate extends Component
{
    public $name;
    public $email;
    public $password;
    public $role = 'user';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
        'role' => 'required|in:admin,user',
    ];

    public function createUser()
    {
        $this->validate();

        try {
            // Realizar llamada a la API para crear usuario
            //dd("llego aca user");
            $response = Http::post(route('api.register'), [
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password,
                'role' => $this->role,
            ]);

            if ($response) {
                session()->flash('message', 'Usuario creado exitosamente.');
                $this->reset();
            } else {
                session()->flash('error', 'Error al crear usuario: ' . $response->json('message'));
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Error en la conexión con el servidor.');
        }
    }

    public function render()
    {
        $roles = Role::pluck('name');
        return view('livewire.user-create', compact('roles'));
    }
}