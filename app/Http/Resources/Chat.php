<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Chat extends JsonResource
{

    public function __construct($resource)
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user1' => $this->user1->name . ' ' . $this->user1->last_name,
            'user2'=> $this->user_id2,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
