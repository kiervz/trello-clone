<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CardResource extends JsonResource
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
            'card_name' => $this->card_name,
            'task_id' => $this->task_id,
            'is_complete' => $this->is_complete,
            'created_at' => $this->created_at->format('M j, Y - G:i')
        ];
    }
}
