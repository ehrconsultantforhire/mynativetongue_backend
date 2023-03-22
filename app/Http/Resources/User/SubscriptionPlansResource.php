<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionPlansResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      
        return 
        [
            'id'=> $this->id,
            // 'plan_name'=>isset($this->name) ? $this->name : 'N/A' ,
            'plan_name'=> $this->planName($this->id),
            'plan_price'=>$this->plan_type == "free" ? "Free" : '$'.$this->price,
            'words'=>$this->words.' Words',

            'product_id' => $this->planProductId($this->id)
        ];
    }

    private function planProductId($plan_id)
    {
        $product_id = env('FREE_PLAN_ID');

        if($plan_id == 2){
            $product_id = env('GOLD_PLAN_ID');
        }
        elseif ($plan_id == 3) {
            $product_id = env('DIAMOND_PLAN_ID');
        }
        elseif ($plan_id == 4) {
            $product_id = env('PLATINUM_PLAN_ID');
        }
        return $product_id;
    }

    private function planName($plan_id)
    {
        
        if($plan_id == 1){
            $name = 'UN Basic';
        }
        elseif($plan_id == 2){
            $name = 'UN Gold';
        }
        elseif ($plan_id == 3) {
            $name = 'UN Diamond';
        }
        elseif ($plan_id == 4) {
            $name = 'UN Platinum';
        }
        return $name;
    }
}
