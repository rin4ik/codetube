<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Channel extends Model
{
    use Sluggable, Searchable;
    protected $fillable = ['name', 'slug', 'description', 'image_filename'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getImage()
    {
        if (!$this->image_filename) {
            return config('codetube.buckets.images') . '/profiles/default.png';
        }
        return config('codetube.buckets.images') . '/profile/' . $this->image_filename;
    }
}
