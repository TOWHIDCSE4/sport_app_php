<?php

namespace App\Repositories;

use App\Interfaces\BaseRepository;
use App\Models\Comment;
use App\Models\Post;

class EloquentPostRepository implements BaseRepository
{
    protected $model;

    public function __construct(Post $post)
    {
        $this->model = $post;
    }

    public function getComents (Post $post, $config = []) {
        $limit = $config['limit'] ?? 20;
        $comments = $post->comments()->with('author', 'likes')
        ->withCount('likes')
        ->withCount('reply')
        ->whereNull('reply_id')
        ->simplePaginate($limit);
        return $comments;
    }
}
