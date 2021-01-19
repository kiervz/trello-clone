<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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
            'name' => $this->name,
            'user_id' => $this->user_id,
            'count_cards' => $this->cards->count(),
            'count_complete' => $this->cardsCompleted->count(),
            'created_at' => $this->created_at->format('M j, Y')
        ];
    }
}
