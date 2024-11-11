<div>
    <div class="py-12 mb-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2>Detalles del Curso</h2>

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
                    @if (!$isRegistered)
                        <button wire:click="register" class="btn btn-success">Registrar en Curso</button>
                    @else
                        <h3>Videos del Curso</h3>
                        @if (!empty($videos))
                            <ul>
                                @foreach ($videos as $video)
                                    <li>
                                        <button
                                            wire:click="selectVideo({{ $video['id'] }})">{{ $video['title'] }}</button>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        @if ($currentVideo)
                            <div>
                                <h4>Viendo: {{ $currentVideo['title'] }}</h4>
                                <iframe width="560" height="315" src="{{ $currentVideo['youtube_url'] }}" frameborder="0"
                                    allowfullscreen></iframe>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
