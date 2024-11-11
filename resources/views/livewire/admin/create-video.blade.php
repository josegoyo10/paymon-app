<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-xl font-bold mb-4">Agregar Nuevo Video</h2>
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
                    <form wire:submit.prevent="createVideo">

                        <div class="mb-3">
                            <label for="title">Título del Video</label>
                            <input type="text" id="title" wire:model="title" class="form-control">
                            @error('title')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description">Descripción</label>
                            <input type="text" id="description" wire:model="description" class="form-control">
                            @error('description')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="course_id">Curso</label>
                            <select id="course_id" wire:model="course_id" class="form-control">
                                <option value="">Seleccione un curso</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                @endforeach
                            </select>
                            @error('course_id')
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
                            <label for="url">URL del Video</label>
                            <input type="text" id="youtube_url" wire:model="youtube_url" class="form-control">
                            @error('url')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>



                        <button type="submit" class="btn btn-primary">Crear Video</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
