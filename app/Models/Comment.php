<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasAdvancedFilter;

    public $table = 'comments';

    protected $fillable = [
        'id',
        'author_id',
        'author_type',
        'post_id',
        'reply_id',
        'content',
        'post_by',
    ];

    public $orderable = [
        'id',
        'author_id',
        'author_type',
        'post_id',
        'reply_id',
        'content',
        'post_by',
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public $filterable = [
        'id',
        'author_id',
        'author_type',
        'post_id',
        'reply_id',
        'content',
        'post_by',
    ];

    protected $appends = ['liked_by_auth_user'];

    /**
     * @return BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function author()
    {
        return $this->morphTo(__FUNCTION__, 'author_type', 'author_id');
    }

    public function reply()
    {
        return $this->hasMany(static::class, 'reply_id');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable', 'target_type', 'target_id');
    }

    public function getLikedByAuthUserAttribute()
    {
        $userId = auth()->user()?->id;
        if (!$userId) {
            return false;
        }

        return $this->likes->contains(function ($like, $key) use ($userId) {
            return $like->source_type == 'user' && $like->source_id == $userId;
        });
    }
}
