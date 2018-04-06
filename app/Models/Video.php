<?php

namespace App\Models;
  
use App\Models\VideoView;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use SoftDeletes,Searchable;

    protected $fillable = [
        'title',
        'description',
        'uid',
        'video_filename',
        'video_id',
        'processed',
        'visibility',
        'allow_votes',
        'allow_comments',
        'processed_percentage'
        ];
    public function views()
    {
        return $this->hasMany(VideoView::class);
    }
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function getRouteKeyName()
    {
        return 'uid';
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function votesAllowed()
    {
        return (bool) $this->allow_votes;
    }

    public function commentsAllowed()
    {
        return (bool) $this->allow_comments;
    }

    public function isProcessed()
    {
        return $this->processed;
    }

    public function getThumbnail()
    {
        if (!$this->isProcessed()) {
            return config('codetube.buckets.videos') . '/default.png';
        }
        return config('codetube.buckets.videos') . '/' . $this->video_id . '_1.jpg';
    }

    public function processedPercentage()
    {
        if ($this->processed == 0) {
            return 'processing ...';
        }
    }

    public function isPrivate()
    {
        return $this->visibility === 'private';
    }

    public function ownedByUser(User $user)
    {
        return $this->channel->user->id === $user->id;
    }

    public function canBeAccessed($user  =null)
    {
        if (!$user && $this->isPrivate()) {
            return false;
        }
        if ($user && $this->isPrivate() && ($user->id !== $this->channel->user_id)) {
            return false;
        }
        return true;
    }

    public function getStreamUrl()
    {
        return config('codetube.buckets.videosu') . '/' . $this->uid . '.mp4';
    }
    public function viewCount()
    {
        return $this->views->count();
    }
   public function votes()
   {
       return $this->morphMany(Vote::class,'voteable');
   }
   public function upVotes()
   {
       return $this->votes->where('type','up');
   }
   public function downVotes()
   {
       return $this->votes->where('type','down');
   }
}
