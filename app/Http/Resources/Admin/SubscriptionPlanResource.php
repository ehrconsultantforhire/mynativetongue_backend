<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionPlanResource extends JsonResource
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
            'price' => $this->price,
            'total_words' => $this->words,
            'min_words' => $this->min_words,
            'show_words' => $this->show_words,
            'team_type' => $this->team_type,
            'teams' => $this->teams,
            'game_play_time' => $this->game_play_time,
            'random_words' => $this->random_words,
            'sound_effects' => $this->sound_effects,
            'plan_type' => $this->plan_type,
            'status' => $this->status,
            'languages' => $this->languages
        ];
    }
}
