<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class LanguageResource extends JsonResource
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
            'code' => $this->code,
            'native_name' => $this->native_name,
            'status' => $this->status,
            'created_at' => $this->created_at->format('jS M Y h:i A'),
            'updated_at' => $this->updated_at->format('jS M Y h:i A')
        ];
    }
}
