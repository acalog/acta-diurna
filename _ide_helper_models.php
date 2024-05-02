<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Comment
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $author
 * @property string $author_ip
 * @property string $subject
 * @property string $body
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereAuthorIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUpdatedAt($value)
 */
	class Comment extends \Eloquent {}
}

namespace App{
/**
 * App\Image
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $filename
 * @property string|null $caption
 * @property string|null $link
 * @property string|null $link_text
 * @property int|null $podcast_id
 * @property int|null $position
 * @property-read \App\Podcast|null $podcast
 * @method static \Illuminate\Database\Eloquent\Builder|Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image query()
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereCaption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereLinkText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image wherePodcastId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereUpdatedAt($value)
 */
	class Image extends \Eloquent {}
}

namespace App{
/**
 * App\Podcast
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $title
 * @property string $description
 * @property string $rss
 * @property \Illuminate\Support\Carbon $published
 * @property int $season
 * @property int $episode
 * @property string $thumbnail
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Image> $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Reference> $references
 * @property-read int|null $references_count
 * @method static \Illuminate\Database\Eloquent\Builder|Podcast newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Podcast newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Podcast query()
 * @method static \Illuminate\Database\Eloquent\Builder|Podcast whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Podcast whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Podcast whereEpisode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Podcast whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Podcast wherePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Podcast whereRss($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Podcast whereSeason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Podcast whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Podcast whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Podcast whereUpdatedAt($value)
 */
	class Podcast extends \Eloquent {}
}

namespace App{
/**
 * App\Post
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $body
 * @property int $views
 * @property int $user_id
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereViews($value)
 */
	class Post extends \Eloquent {}
}

namespace App{
/**
 * App\Reference
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $label
 * @property string|null $url
 * @property int|null $podcast_id
 * @property-read \App\Podcast|null $podcast
 * @method static \Illuminate\Database\Eloquent\Builder|Reference newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reference newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reference query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reference whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reference whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reference whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reference wherePodcastId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reference whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reference whereUrl($value)
 */
	class Reference extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Post> $posts
 * @property-read int|null $posts_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

