<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Api\User\User;
use App\Models\Api\User\UserSubscriptionPlan;
use App\Models\Api\Admin\SubscriptionPlan;
use App\Models\Api\User\SubscriptionPlanTransaction;
use Auth;
use Session;
use Response;
use DB;
use File;

class SubscriptionController extends Controller
{

  /**
     * @OA\Post(
     ** path="/user/assign-plan",
     *   tags={"User"},
     *   summary="Assign Plan",
         security={{"bearerAuth":{}}}, 
     *   operationId="assign-plan",
     *
     *   @OA\Parameter(
     *      name="user_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="plan_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *    @OA\Response(
     *          response=404,
     *          description="Not Found",
     *      ),
     *)
     **/
  public function assignSubscriptionPlan(Request $request)
  {
    if(isset($request->user_id) && $request->user_id != null  && isset($request->plan_id) && $request->plan_id != null  )
    {
      $plan_id_array = [env('FREE_PLAN_ID'),env('GOLD_PLAN_ID'),env('DIAMOND_PLAN_ID'),env('PLATINUM_PLAN_ID')];
      if(in_array($request->plan_id, $plan_id_array))
      {
        $plan = SubscriptionPlan::where('plan_id',$request->plan_id)->first();
        UserSubscriptionPlan::updateOrCreate(
        [
          'user_id' => $request->user_id
        ],
        [
          "user_id" => $request->user_id,
          "plan_id" => $plan->id,
          "subscription_start_date" => date('Y-m-d'),
          "subscription_end_date" => date('Y-m-d'),
          "status" => 'active',
        ]);

        $show_ad = 'true';
        if($plan->id == 3 || $plan->id == 4){
          $show_ad = 'false';
        }
        $user = User::updateOrCreate(
        [
          'id' => $request->user_id
        ],
        [
          "is_subscribed" => 'true',
          "show_ad" => $show_ad
        ]);

        if($user->email == null )
        {
          $user->email = "";
        }
        
        if($user->country_code == null)
        {
          $user->country_code = "";
        }
        
        $user->plan_id = $plan->id;
        $user->product_id = $request->plan_id;
        $data =
        [
          'id' => $request->user_id,
          'token' => $request->bearerToken(),
          'user'=> $user
        ];
        return $this->returnResponse(true,200,'Subscription assigned successfully!!.',$data);
      }
      else
      {
        return $this->returnResponse(false,404,'Subscription plan not exist');
      }  
    }
    else
    {
      return $this->returnResponse(false,404,'Subscription plan info not get.');
    }
  }
}
