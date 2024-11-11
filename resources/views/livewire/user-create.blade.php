<div>
    <div class="fixed inset-0 flex items-center justify-center z-50">
        <div class="bg-gray-800 bg-opacity-75 fixed inset-0"></div>
        <div class="bg-white rounded-lg shadow-lg p-6 z-10 w-full max-w-lg">
            <h2 class="text-xl font-bold mb-4">Crear Usuario</h2>

            @if (session()->has('message'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('message') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form wire:submit.prevent="createUser">
                <div class="mb-3">
                    <label for="name">Nombre</label>
                    <input type="text" id="name" wire:model="name" class="form-control">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" id="email" wire:model="email" class="form-control">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" wire:model="password" class="form-control">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="role">Rol</label>
                    <select id="role" wire:model="role" class="form-control">
                        <option value="user">Usuario</option>
                        <option value="admin">Administrador</option>
                    </select>
                    @error('role')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Crear Usuario</button>
            </form>
        </div>
    </div>
</div>
