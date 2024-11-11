<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2>Mis Cursos</h2>

                    @if (session()->has('error'))
                        <div style="color: red;">{{ session('error') }}</div>
                    @endif


                    <h3>Resultados:</h3>
                    @if (!empty($courses))

                        @foreach ($courses as $course)
                            <div
                                class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mb-3">
                                <a href="#">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        {{ $course['title'] }} - {{ $course['age_group'] }}</h5>
                                </a>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                    {{ $course['description'] }}</p>

                                <div class="mb-3">
                                    <a href="{{ url('video-curso/' . $course['id']) }}"
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        Ver video Curso
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>No se encontraron cursos.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
