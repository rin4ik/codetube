<?php

namespace App\Http\Controllers;

class VideoController extends Controller
{
    public function store()
    {
        $uid = uniqid(true);
        $channel = request()->user()->channel()->first();

        $video1 = $channel->videos();

        $video = $channel->videos()->create([
            'uid' => $uid,
            'title' => request()->title,
            'description' => request()->description,
            'visibility' => request()->visibility,
            'video_filename' => "{$uid}." . request()->extension
            ]);
        return response()->json([
                'data' => [
                    'uid' => $uid,
                    ]
            ]);
    }
}
