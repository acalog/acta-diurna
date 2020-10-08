<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'created_at',
        'updated_at',
        'hash',
        'size',
        'filename',
        'path',
        'width',
        'height',
        'fps'
    ];

    public function thumbnail()
    {
        # Video Has Thumbnail
        # Defines A One-To-One Relationship
        return $this->hasOne('App\Thumbnail');
    }

    public function user()
    {
        # Activity Belongs To User
        # Defines An Inverse One-To-Many Relationship
        return $this->belongsTo('App\User');
    }

    public function gif()
    {
        # Video Has Thumbnail
        # Defines A One-To-One Relationship
        return $this->hasOne('App\Gif');
    }

    public function tags()
    {
        # Video has many tags
        # Define a many-to-many relationship
        return $this->belongsToMany('App\Tag');
    }
}
