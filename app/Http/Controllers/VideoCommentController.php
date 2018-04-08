<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Transformers\CommentTransformer;

class VideoCommentController extends Controller
{
    public function index(Video $video)
    {
        return response()->json(
        fractal()->collection($video->comments()->latestFirst()->get())
        ->parseIncludes(['channel', 'replies', 'replies.channel'])
        ->transformWith(new CommentTransformer)
        ->toArray()
      );
    }
}
