<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Jobs\UploadImage;
use App\Http\Requests\ChannelUpdateRequest;

class ChannelSettingsController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Channel $channel)
    {
        // $this->authorize('update', $channel);
      
        return view('channel.settings.edit', compact('channel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ChannelUpdateRequest $request, Channel $channel)
    {
        $this->authorize('update', $channel);

        $channel->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
        ]);
        if ($request->file('image')) {
            $request->file('image')->move(
                storage_path() . '/uploads',
                $fileId = uniqid(true)
        );
            $this->dispatch(new UploadImage($channel, $fileId));
        }
        return redirect('/channel/' . $request->slug . '/edit');
    }
}
