<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Admin\SalesReportResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\Api\User\UserSubscriptionPlan;
use App\Models\Api\User\User;
use DB;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

  /**
    @OA\Get(
     path="/admin/analytics",
     tags={"Admin"},
       summary="Analytics",
       security={{"bearerAuth":{}}}, 
       operationId="analytics",
       
        @OA\Parameter(
          name="year",
          in="query",
          required=true,
            @OA\Schema(
                type="integer"
            )
        ),
        @OA\Response(
          response=200,
           description="Success",
            @OA\MediaType(
                mediaType="application/json",
            )
        ),
        @OA\Response(
            response=401,
            description="Unauthenticated",
        ),
        @OA\Response(
            response=404,
            description="Not Found",
        ),
    )
    **/  
  public function index(Request $request)
  {
    $from_year = $request->year.'-'.'01'.'-'.'01';
    $to_year = $request->year.'-'.'12'.'-'.'31';
    $plans =  UserSubscriptionPlan::whereBetween('created_at',[$from_year,$to_year])->orderBy('id','asc')->get();
    $sorted_plans_array = $plans->groupBy([function ($val)
    {
      return Carbon::parse($val->created_at)->format('m');
    }])->toArray();
    
    $months_array = [1,2,3,4,5,6,7,8,9,10,11,12];
    
    $months_plan_count_array = [];
    foreach ($months_array as $key => $month) 
    {
      $plans_count = 0;
      if(!empty($sorted_plans_array))
      {
        foreach ($sorted_plans_array as $key => $month_wise) 
        { 
          if ((int)$key === (int)$month) 
          {
            $plans_count = count($month_wise);
          }
          $months_plan_count_array[$month] = $plans_count;
        }
      }
      else
      {
        $months_plan_count_array[$month] = $plans_count;
      }
    }

    $subscribed_users =  User::whereHas('subscribedUser')->count();
    $total_users =  User::where('role_id','!=',1)->count();
    $normal_users = (int)$total_users - (int)$subscribed_users;
    $users = [];
    $users['total_users'] = $total_users;
    $users['subscribed_users'] = $subscribed_users;
    $users['non_subscribed_users'] = $normal_users;
      
    $data = [];
    $data['analytics_bar'] =  $months_plan_count_array;
    $data['analytics_donut'] =  $users;
    return $this->returnResponse(true,200,'Analytics data', $data);
  }   
}
