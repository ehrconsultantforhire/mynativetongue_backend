<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email' => $this->email != null  ? $this->email : 'N/A' ,
            'age' => $this->age != null  ? $this->age : 'N/A' ,
            'mobile_no' => $this->country_code.$this->mobile_no ,
            'status' => $this->status,
            'created_at' => $this->created_at->format('jS M Y h:i A'),
            'updated_at' => $this->updated_at->format('jS M Y h:i A')
        ];
    }
}
