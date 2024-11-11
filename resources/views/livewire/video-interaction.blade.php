<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3>Interacción con el Video</h3>

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

                    <button wire:click="toggleLike" class="btn btn-success btn-md">
                        {{ $userHasLiked ? 'Quitar Like' : 'Dar Like' }}
                    </button>
                    <h4>Nro Likes:</h4>
                    <span>{{ $likesCount }}</span>

                    <h4>Comentarios:</h4>
                    <ul class="list-disc">
                        @foreach ($comments as $comment)
                        <li>{{ $comment['name'] }}: {{ $comment['content'] }}</li>
                        @endforeach
                    </ul>
                    <br>
                    <div class="mb-4">
                        <input type="text" wire:model="newComment" placeholder="Agregar comentario"
                            class="form-control">
                    </div>
                    <div class="mb-3">
                        <button wire:click="addComment" class="btn btn-primary btn-md">Comentar</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>