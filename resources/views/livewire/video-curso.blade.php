<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3>Videos del Curso</h3>
                    @if (!empty($videos))
                    <ul>
                        @foreach ($videos as $video)
                        <li>
                            <h4>Viendo: {{ $video['title'] }}</h4>
                            <h4>Descripción: {{ $video['description'] }}</h4>
                            <iframe width="560" height="315" src="{{ $video['youtube_url'] }}" frameborder="0"
                                allowfullscreen></iframe>
                            <div class="mb-3">
                                <a href="{{ url('add-comment/'.$video['id']) }}"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Agregar Comentario
                            </a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>