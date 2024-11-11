<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-xl font-bold mb-4">Crear Curso</h2>
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

                    <form wire:submit.prevent="createCourse">
                        <div class="mb-3">
                            <label for="title">Título del curso</label>
                            <input type="text" id="title" wire:model="title" class="form-control">
                            @error('title')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description">Descripción</label>
                            <textarea id="description" wire:model="description" class="form-control"></textarea>
                            @error('description')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category_id">Categoría</label>
                            <select id="category_id" wire:model="category_id" class="form-control">
                                <option value="">Seleccione una categoría</option>
                                @foreach ($this->categories as $category)
                                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="age_group">Grupo de edad</label>
                            <select id="age_group" wire:model="age_group" class="form-control">
                                <option value="">Seleccione un grupo de edad</option>
                                <option value="5-8">5-8</option>
                                <option value="9-13">9-13</option>
                                <option value="14-16">14-16</option>
                                <option value="16+">16+</option>
                            </select>
                            @error('age_group')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Crear Curso</button>
                    </form>

                </div>
            </div>
        </div>

    </div>
</div>

