<?php

namespace App\Repositories;

use App\Interfaces\BaseRepository;
use App\Models\Comment;
use App\Models\Post;

class EloquentCommentRepository implements BaseRepository
{
    protected $model;

    public function __construct(Comment $comment)
    {
        $this->model = $comment;
    }
    public function getReply (Comment $comment, $config = []) {
        $limit = $config['limit'] ?? 20;
        $comments = $comment->reply()->with('author', 'likes')
        ->withCount('likes')
        ->withCount('reply')
        ->simplePaginate($limit);
        return $comments;
    }
}
