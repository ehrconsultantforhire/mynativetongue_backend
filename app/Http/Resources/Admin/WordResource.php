<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class WordResource extends JsonResource
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
            'plan_id' => $this->plan_id,
            'language_id' => $this->language_id,
            'word' => $this->word,
            'status' => $this->status,
           // 'created_at' => $this->created_at->format('jS M Y h:i A'),
            // 'updated_at' => $this->updated_at->format('jS M Y h:i A')
        ];
    }
}
