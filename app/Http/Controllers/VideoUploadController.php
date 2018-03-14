<?php

namespace App\Http\Controllers;

class VideoUploadController extends Controller
{
    public function index()
    {
        return view('video.upload');
    }

    public function store()
    {
        $channel = request()->user()->channel()->first();
        $video = $channel->videos()->where('uid', request()->uid)->firstOrFail();
        request()->file('video')->move(storage_path() . '/uploads', $video->video_filename);
    }
}
