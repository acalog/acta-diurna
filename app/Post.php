<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\Query\Builder;

class Post extends Model
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'posts';

    public function user()
    {
        # Activity Belongs To User
        # Defines An Inverse One-To-Many Relationship
        return $this->belongsTo('App\User');
    }

    /**
     * Returns user's most recent post.
     *
     * @param $user_id
     * @return Model|Builder|object|null
     */
    public static function mostRecent($user_id)
    {
        return DB::table('posts')
                ->where('user_id', $user_id)
                ->latest()
                ->first();
    }

}
