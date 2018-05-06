<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use TCG\Voyager\Contracts\User as Voyager;
use TCG\Voyager\Traits\VoyagerUser;

class User extends Authenticatable implements Voyager
{
    use Notifiable, VoyagerUser;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function channel()
    {
        return $this->hasMany(Channel::class);
    }

    public function videos()
    {
        return $this->hasManyThrough(Video::class, Channel::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function subscribedChannels()
    {
        return $this->belongsToMany(Channel::class, 'subscriptions');
    }

    public function isSubscribedTo(Channel $channel)
    {
        return (bool) $this->subscriptions->where('channel_id', $channel->id)->count();
    }

    public function ownsChannel(Channel $channel)
    {
        return (bool) $this->channel->where('id', $channel->id)->count();
    }
}
