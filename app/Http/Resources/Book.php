<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class Book extends JsonResource
{
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
            'title' => $this->title,
            'author' => $this->author,
            'editorial' => $this->editorial,
            'year_edition'=> $this->year_edition,
            'price' => $this->price,
            'pages' => $this->pages,
            'synopsis' => $this->synopsis,
            'cover_page' => $this->cover_page,
            'back_cover' => $this->back_cover,
            'available' => $this->available,
            'new' => $this->new,
            'category' => "/api/categories/" .$this->category_id,
            'user' => "/api/users/" .$this->user_id
        ];
    }
}
