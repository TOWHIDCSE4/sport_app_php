<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Controllers\API\Bookmark\BookmarkController;
use App\Models\Venue;

class BookMarkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $target = $this->target_type.'_bookmark';
        $meta_data = [];
        $full_name = '';

        #event
        if (isset($target) && $this->target_type == BookmarkController::TARGET_TYPE_ARRAY[0]) {

            $full_name = isset($this->$target->user_create) ? trim($this->$target->user_create->first_name .' ' .$this->$target->user_create->last_name):'';

            $meta_data = [
                'title' => $this->$target->title ?? '',
                'creator_id' => $this->$target->creator_id ?? null,
                'full_name' =>$full_name,
                'event_type' => $this->$target->event_type ?? null,
                'start_date' => $this->$target->start_date_time ?? null,
                'end_date' => $this->$target->end_date_time ?? null,
                'location' => $this->$target->location ?? null,
                'image' => $this->$target->images(),
            ];
        }
        #post
        if (isset($target) && $this->target_type == BookmarkController::TARGET_TYPE_ARRAY[1]) {
            if (isset($this->$target->creator_type) && $this->$target->creator_type === 'user') {
                $full_name = isset($this->$target->user_post) ? trim($this->$target->user_post->first_name .' ' .$this->$target->user_post->last_name):'';
            }
            if (isset($this->$target->creator_type) && $this->$target->creator_type === 'team') {
                $full_name = isset($this->$target->team_post) ? trim($this->$target->team_post->name):'';
            }
            $meta_data = [
                'creator_id' => $this->$target->creator_id ?? null,
                'creator_type' => $this->$target->creator_type ?? null,
                'full_name' =>$full_name,
                'content' => $this->$target->content ?? null,
                'count_like' => isset($this->$target->like_post)?count($this->$target->like_post):0,
                'count_comment' => isset($this->$target->comment_post)?count($this->$target->comment_post):0,
                'count_bookmark' => isset($this->$target->bookmark_post)?count($this->$target->bookmark_post):0,
                'image' => $this->$target->imagesUrl(),
            ];
        }
        #user
        if (isset($target) && $this->target_type == BookmarkController::TARGET_TYPE_ARRAY[2]) {
            $full_name = isset($this->$target) ? trim($this->$target->first_name .' ' .$this->$target->last_name):'';
            $is_following = false;
            if (isset($this->user->user_interections)) {
                foreach ($this->user->user_interections as $key => $interection) {
                    if ($interection->first_id == $this->user_id && $interection->first_type === 'user' && $interection->last_id == $this->target_id && $interection->last_type === 'user') {
                        $is_following = true;
                    }
                }
            }
            $meta_data = [
                'full_name' =>$full_name,
                'is_following' => $is_following,
                'image' => $this->$target->getAvatarUrl(),
            ];
        }
        #vanue
        if (isset($target) && $this->target_type == BookmarkController::TARGET_TYPE_ARRAY[3]) {
            $full_name = isset($this->$target) ? trim($this->$target->name):'';
            $is_popularity = false;
            if (isset($this->$target->id)) {
                $popularVenue = Venue::whereNull('deleted_at')->whereNotNull('popularity')->orderBy('popularity', 'DESC')->take(10)->pluck('id')->toArray();
                if (in_array($this->$target->id,$popularVenue)) {
                    $is_popularity = true;
                }
            }
            $meta_data = [
                'name' =>$full_name,
                'address' => $this->$target->address,
                'is_popularity' => $is_popularity,
            ];
        }

        $return =  [
            'user_id' => $this->user_id,
            'target_id' => $this->target_id,
            'target_type' => $this->target_type,
        ];

        return array_merge($return, [
            'meta_data' => $meta_data,
        ]);
    }
}
