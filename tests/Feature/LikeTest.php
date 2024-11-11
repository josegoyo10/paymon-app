<?php

namespace Tests\Feature;
use App\Models\User;
use App\Models\Video;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LikeTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_user_can_toggle_like_on_video()
    {
        $user = User::factory()->create();
        $video = Video::factory()->create();

        // Dar like
        $this->actingAs($user, 'sanctum')
             ->postJson("/api/videos/{$video->id}/like")
             ->assertStatus(200)
             ->assertJson(['message' => 'Like agregado']);

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'video_id' => $video->id,
        ]);

        // Quitar like
        $this->postJson("/api/videos/{$video->id}/like")
             ->assertStatus(200)
             ->assertJson(['message' => 'Like eliminado']);

        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'video_id' => $video->id,
        ]);
    }
}
