<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    protected $fillable = ['title', 'description', 'published', 'season', 'episode', 'rss', 'thumbnail'];

    protected $with = ['images', 'references'];

    protected $casts = ['published' => 'date'];

    public function images()
    {
        # Podcast Has Many Images
        # Defines A One-To-Many Relationship
        return $this->hasMany('App\Image');
    }

    public function references()
    {
        # Podcast Has Many References
        # Defines A One-To-Many Relationship
        return $this->hasMany('App\Reference');
    }


}
