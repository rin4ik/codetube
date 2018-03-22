<?php

namespace App\Http\Controllers;

use App\Models\Video;

class VideoViewController extends Controller
{
    public function store(Video $video)
    {
        if (!$video->canBeAccessed(request()->user())) {
            return;
        }
        $video->views()->create([
            'user_id' => request()->user() ? request()->user()->id : null,
            'ip' => request()->ip()
        ]);
        return response()->json(null, 200);
    }
}
