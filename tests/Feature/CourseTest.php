<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class CourseTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_admin_can_create_course()
{
    $admin = User::factory()->create(['role' => 'admin']);

    $response = $this->post('/api/courses', [
        'title' => 'Curso de Prueba',
        'description' => 'Descripción del curso',
        'category_id' => 1,
        'age_group' => '9-13'
    ]);

    $response->assertStatus(201);
    $this->assertDatabaseHas('courses', ['title' => 'Curso de Prueba']);
}

}
