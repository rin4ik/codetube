<?php

namespace App\Models;
 
use App\Models\VideoView;
use App\Traits\Orderable;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
   use SoftDeletes,Searchable,Orderable;

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
   public function comments()
   {
       return $this->morphMany(Comment::class, 'commentable')->where('reply_id',null);
   }
    /**
     * toSearchableArray algolia
     *
     * @return void
     */
    public function toSearchableArray()
    {
        $properties = $this->toArray();
        $properties['visible']= $this->isProcessed() && $this->isPublic();
        return $properties;
    }
    public function isPublic()
    {
        return $this->visibility === 'public';
    }
   public function getRouteKeyName()
   {
       return 'uid';
   }

public function scopeProcessed($query)
{
    return $query->where('processed',true);
}
public function scopePublic($query)
{
    return $query->where('visibility','public');
}
public function scopeVisible($query)
{
    return $query->processed()->public();
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
  public function voteFromUser(User $user)
  {
      return $this->votes->where('user_id',$user->id);
  }
}