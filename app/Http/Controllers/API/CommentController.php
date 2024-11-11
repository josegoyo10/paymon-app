<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class CommentController extends Controller
{
    public function index(Request $request, $videoId) {
        $comments = Comment::JOIN('users', 'users.id','=', 'comments.user_id')
          ->where('video_id', '=', $videoId)->get();
        return response()->json(['comments' => $comments]);

    }
    //
    public function store(Request $request, Video $video)
    {

              $request->validate([
            'content' => 'required|string|max:500',
        ]);
//
        $comment = $video->comments()->create([
            'user_id' => Auth::user()->id,
            'content' => $request->content,
        ]);
        return response()->json(data: ['comment' => $comment, 'message' => 'Comentario agregado con éxito']);
    }

    
}
