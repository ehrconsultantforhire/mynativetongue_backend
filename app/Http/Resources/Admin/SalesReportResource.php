<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class SalesReportResource extends JsonResource
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
            'user_name' => $this->user->name,
            'registered_at' => $this->user->created_at->format('M d,Y'),
            'country_code' => $this->user->country_code,
            'plan_type' => $this->plan->name,
            'plan_date' => $this->subscription_start_date,
        ];
    }
}
