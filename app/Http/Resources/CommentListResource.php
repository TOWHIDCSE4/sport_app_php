<?php

namespace App\Http\Resources;

use Illuminate\Support\Arr;

class CommentListResource extends CommentResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $teamIds = $request->teamIds??[];
        $data = parent::toArray($request);
        $authorAvatar = null;
        switch($data['author_type']) {
            case "team":
                $authorAvatar = $data['author']['team_avatar_image'];
                break;
            case "user":
                $authorAvatar = $data['author']['avatar'];
                break;
            default:
                break;
        }
        $author = Arr::only($data['author'], [
            'name'
        ]);
        $author['avatar'] = $authorAvatar;
        $data = array_merge($data, [
            'author' => $author,
            'count_like' => $this->likes_count,
            'count_comment' => $this->reply_count, 
            'is_liked' => $this->liked_by_auth_user, 
            'is_owned' => $request->user()->id == $data['author_id'] && $data['author_type'] == 'user' 
            ||  in_array($data['author_id'], $teamIds)  && $data['author_type'] == 'team' ,
        ]);
        return Arr::only($data, [
            'id',
            'content',
            'author_id',
            'author_type',
            'reply_id',
            'author',
            'count_like',
            'count_comment',
            'created_at',
            'is_liked',
            'is_owned',
        ]);
    }
}
