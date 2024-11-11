<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class VideoInteraction extends Component
{
    public $videoId;
    public $comments = [];
    public $newComment;
    public $likesCount;
    public $userHasLiked = false;

    public function mount($videoId)
    {
        $this->videoId = $videoId;
        $this->loadComments();
        $this->loadLikes();
    }

    public function loadComments()
    {
        $response = Http::get(route('api.videos.comments', ['video' => $this->videoId]));
        $this->comments = $response->json('comments');
    }

    public function addComment()
    {
        //dd("llego video");
        if (empty($this->newComment)) return;
        //dd("llamando servicio post:".$this->newComment );
        try {
            // Realizar llamada a la API para crear comentario
           //dd("id Video:". $this->videoId);
            $response = Http::post(route('api.comments.store', ['video' =>  $this->videoId]));

            if ($response) {
                session()->flash('message', 'comentario creado exitosamente.');
                $this->loadComments();
                $this->reset();
            } else {
                session()->flash('error', 'Error al crear comentario: ' . $response->json('message'));
            }
        } catch (\Exception $e) {
            session()->flash('error', $e);
        }

        $this->newComment = '';

    }

    public function loadLikes()
    {
        $response = Http::post(route('api.videos.like', ['video' => $this->videoId]));

        $this->userHasLiked = $response->json('liked');
        $this->likesCount = $response->json('likes_count');
    }

    public function toggleLike()
    {
        $this->loadLikes();
    }

    public function render()
    {
        return view('livewire.video-interaction');
    }
}
