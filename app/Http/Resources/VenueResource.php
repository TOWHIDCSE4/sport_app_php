<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VenueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);
        $data['banner'] = $this->getBackground();
        unset($data['upload_photo']);
        unset($data['owner']['media']);
        unset($data['media']);

        return $data;
    }
}
