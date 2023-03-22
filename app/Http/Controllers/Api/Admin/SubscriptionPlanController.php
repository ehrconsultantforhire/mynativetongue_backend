<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Admin\SubscriptionPlanResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\Api\Admin\SubscriptionPlan;
use App\Models\Api\User\SubscriptionPlanLanguage;
use DB;
use Auth;

class SubscriptionPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
    @OA\Get(
     path="/admin/subscription-plan",
     tags={"Admin"},
       summary="Subscription Plans Listing",
       security={{"bearerAuth":{}}}, 
       operationId="plans-listing",
       
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
    public function index(Request $request):ResourceCollection
    {
        return SubscriptionPlanResource::collection(SubscriptionPlan::where('status','active')->orderBy('id','asc')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateValidation $request)
    {
        //
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Patch(
     ** path="/admin/subscription-plan/{plan_id}",
     *   tags={"Admin"},
     *   summary="Update Subscription Plan",
     *   security={{"bearerAuth":{}}}, 
     *   operationId="update-plan",
     *
      @OA\RequestBody(
        @OA\MediaType(
          mediaType="application/json",
            @OA\Schema(
                collectionFormat="multi",
                @OA\Property(property="name", type="string",),
                @OA\Property(property="price", type="number",),
                @OA\Property(property="show_words", type="integer",),
                @OA\Property(
                  property="plan_languages",
                  type="array",
                  format="query",
                  @OA\Items(
                    
                  ),
                ),
            ),
        ),
      ),
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
     *      @OA\Response(
     *          response=404,
     *          description="Not Found",
     *      ),
     *)
    **/
    public function update(Request $request, $id)
    {
        $plan = SubscriptionPlan::find($id);
        if($plan)
        {   
            // if($id == 3)
            // {
            //     $golden_plan = SubscriptionPlan::find(2);
            //     $total_words = (int)$golden_plan->words + (int)$request->show_words;
            // }
            // else
            // {
            //     $total_words = $request->show_words;
            // }
            $plan->name = $request->name;
            $plan->price = isset($request->price) ? $request->price : 0;
            // $plan->words = $total_words;
            $plan->words = $request->show_words;
            $plan->show_words = $request->show_words;
            // $plan->team_type = $request->team_type;
            // $plan->teams = $request->teams;
            // $plan->game_play_time = $request->game_play_time;
            // $plan->random_words = $request->random_words;
            // $plan->sound_effects = $request->sound_effects;
            $plan->action_by = Auth::User()->id;
            $plan->save();

            SubscriptionPlanLanguage::where('plan_id',$id)->delete();
            if(!empty($request->plan_languages))
            {
                foreach ($request->plan_languages as $key => $plan_language) 
                {
                    $langauage_plan = new SubscriptionPlanLanguage();
                    $langauage_plan->plan_id = $id;
                    $langauage_plan->language_id = $plan_language;
                    $langauage_plan->status = 'active';
                    $langauage_plan->save();
                }
            }
                
            return $this->returnResponse(true,200,'Plan updated.',$plan);
            
        }
        else
        {
            return $this->returnResponse(false,200,'plan not found');
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
