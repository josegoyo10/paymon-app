<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Video;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_add_comment_to_video()
    {
        $user = User::factory()->create();
        $video = Video::factory()->create();
        
        $this->actingAs($user, 'sanctum')
             ->postJson("/api/videos/{$video->id}/comments", ['content' => 'Buen video'])
             ->assertStatus(200)
             ->assertJsonStructure(['comment', 'message']);
        
        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'video_id' => $video->id,
            'content' => 'Buen video',
        ]);
    }

    public function test_comment_belongs_to_user_and_video()
    {
        $user = User::factory()->create();
        $video = Video::factory()->create();
        $comment = Comment::factory()->create(['user_id' => $user->id, 'video_id' => $video->id]);

        $this->assertInstanceOf(User::class, $comment->user);
        $this->assertInstanceOf(Video::class, $comment->video);
    }
}

