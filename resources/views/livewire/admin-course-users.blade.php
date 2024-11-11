<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2>Usuarios Registrados en el Curso: {{ $courseData }}</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre del Usuario</th>
                                <th>Video Actual</th>
                                <th>Progreso</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user['user_name'] }}</td>
                                    <td>{{ $user['current_video'] ?? 'No iniciado' }}</td>
                                    <td>{{ $user['progress'] }}%</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
