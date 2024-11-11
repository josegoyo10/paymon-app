<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    //
    public function toggleLike(Request $request, Video $video)
    {
        $user = $request->user();

        $like = $video->likes()->where('user_id', $user->id)->first();

        if ($like) {
            $like->delete();
            return response()->json(['message' => 'Like eliminado']);
        } else {
            $video->likes()->create(['user_id' => $user->id]);
            return response()->json(['message' => 'Like agregado']);
        }
    }
}
