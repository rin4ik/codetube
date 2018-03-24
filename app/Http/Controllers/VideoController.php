<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Http\Requests\VideoUpdateRequest;

class VideoController extends Controller
{
    public function index()
    {
        $videos = request()->user()->videos()->latestFirst()->paginate(10);
        $app = new User;
dd($app);        
        return view('video.index', compact('videos'));
    }

    public function show(Video $video)
    {
        return view('video.show', compact('video'));

 
    }

    public function edit(Video $video)
    {
        $this->authorize('edit', $video);

        return view('video.edit', compact('video'));
    }

    public function update(VideoUpdateRequest $request, Video $video)
    {
        $this->authorize('update', $video);
      
        $video->update([
            'title' => $request->title,
            'description' => $request->description,
            'visibility' => $request->visibility,
            'allow_votes' => $request->has('allow_votes'),
            'allow_comments' => $request->has('allow_comments'),
        ]);
        if ($request->ajax()) {
            return response()->json(null, 200);
        }
        return redirect()->back();
    }

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

    public function delete(Video $video)
    {
        $this->authorize('delete', $video);
        $video->delete();
        return redirect()->back();
    }
}
