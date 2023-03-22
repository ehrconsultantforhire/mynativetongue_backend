<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Api\User\User;
use App\Http\Resources\Admin\LanguageResource;
use App\Http\Resources\User\TeamMemberResource;
use App\Http\Resources\User\RandomWordResource;
use App\Http\Resources\User\LeaderBoardResource;
use App\Http\Resources\User\SubscriptionPlanResource;
use App\Http\Resources\User\SubscriptionPlansResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\Api\Admin\Language;
use App\Models\Api\Admin\Word;
use App\Models\Api\User\Team;
use App\Models\Api\User\TeamMember;
use App\Models\Api\User\PlayGame;
use App\Models\Api\User\SubscriptionPlanLanguage;
use App\Models\Api\User\UserSubscriptionPlan;
use App\Models\Api\Admin\SubscriptionPlan;
use Auth;
use Session;
use Response;
use DB;
use File;

class GameController extends Controller
{
    /**
     * @OA\Get(
     ** path="/user/language-list",
     *   tags={"User"},
     *   summary="Language Listing",
     *   security={{"bearerAuth":{}}}, 
     *   operationId="language",
     *   
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *    ),
     *)
    **/

    public function languageList(Request $request):ResourceCollection
    {
      // $plan_id = UserSubscriptionPlan::where('user_id',Auth::User()->id)->first()->plan_id;
      // return LanguageResource::collection(Language::whereHas('subscriptionPlanLanguage',function($q)  use($plan_id){
      //   $q->where(['plan_id'=> $plan_id,'status'=> 'active']);
      // })->where('status','active')->orderBy('id','asc')->get());
      return LanguageResource::collection(Language::where('status','active')->orderBy('id','asc')->get());
    }

    /**
     * @OA\Get(
     ** path="/user/avatar-list",
     *   tags={"User"},
     *   summary="Avatar Listing",
     *   security={{"bearerAuth":{}}}, 
     *   operationId="avatar-list",
     *   
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *    ),
     *)
    **/
    public function avatarList(Request $request)
    {
      $path = public_path('avatars');
      $avatars = File::files($path);
      $avatars_url_array = [];
      foreach ($avatars as $key => $avatar) 
      {
        if($avatar->getFilename() != 'placeholder@3x.png')
        {
          $avatars_url_array[] = env('APP_URL').'/avatars'.'/'.$avatar->getFilename();
        }
      }
      return $this->returnResponse(true,200,'Avatars get successfully!!.',$avatars_url_array);
    }

  /**
  @OA\Post(
  path="/user/save-team-members-info",
  tags={"User"},
  summary="Save Team Members Info",
  security={{"bearerAuth":{}}}, 
  operationId="save-team-members-info",
     
    @OA\RequestBody(
      @OA\MediaType(
        mediaType="application/json",
        @OA\Schema(
          collectionFormat="multi",
          @OA\Property(
            property="team_members",
            type="array",
            format="query",
            @OA\Items(
              @OA\Property(property="member_name", type="string",),
              @OA\Property(property="language_id", type="integer",),
              @OA\Property(property="language_name", type="string",),
              @OA\Property(property="avatar_type", type="string",),
              @OA\Property(property="avatar", type="string",),
            ),
          ),
        ),
      ),
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
    public function saveTeamMembersInfo(Request $request)
    {
      if(isset($request->team_members) && !empty($request->team_members))
      {
        $team = new Team();
        $team->user_id = Auth::User()->id;
        $team->game_id = $this->generateUniqueGameId();
        $team->save();

        foreach ($request->team_members as $key => $member) 
        {
          if(!empty($member) && isset($member['member_name']) && isset($member['language_id']) && isset($member['avatar_type'])  && $member['member_name'] != null && $member['language_id'] != null && $member['avatar_type'] != null  && is_int($member['language_id']) )
          {
            if($member['avatar_type'] == 'gallery')
            { 
              $folderPath =  public_path('images');
              $image_parts = explode(";base64,", $member['avatar']);
              $image_type_aux = explode("image/", $image_parts[0]);
              $image_type = $image_type_aux[1];
              $image_base64 = base64_decode($image_parts[1]);
              $unique_id = uniqid();
              $file = $folderPath .'/'. $unique_id . '.'.$image_type;
              $db_file_url = env('APP_URL').'/'.'images'.'/'. $unique_id . '.'.$image_type;
              file_put_contents($file, $image_base64);
              $avatar_url = $db_file_url;
            }
            elseif ($member['avatar_type'] == 'avatar') 
            {
              if($member['avatar'] != "")
              {
                $avatar_url = $member['avatar'];
              }
              else
              {
                $avatar_url = env('APP_URL').'/'.'avatars'.'/'.'placeholder@3x.png';
              }
              
            }

            $team_member = new TeamMember();
            $team_member->team_id = $team->id;
            $team_member->member_name = $member['member_name'];
            $team_member->language_id = $member['language_id'];
            $team_member->avatar_url  = $avatar_url;
            $team_member->save();
          }
        }
        return $this->returnResponse(true,200,'Team members saved successfully!!.',$team->id);
      }
      else
      {
        return $this->returnResponse(false,404,'Team members info not get.');
      }
    }

    public function deleteTeamMembersInfo(Request $request)
    {
      if(isset($request->team_id) && is_int($request->team_id) && $request->team_id)
      {
        $team = Team::where('id',$request->team_id)->first();
        if(isset($team->id) && $team->id)
        {
          $team->delete();
          return $this->returnResponse(true,200,'Team members info deleted.');
        }
        else
        {
          return $this->returnResponse(false,200,'Team not found.');
        }
      }
      else
      {
        return $this->returnResponse(false,200,'Team id not get.');
      }
    }


    /**
     * @OA\Get(
     ** path="/user/get-team-members-info/{team_id}",
     *   tags={"User"},
     *   summary="Get Team Members Info",
     *   security={{"bearerAuth":{}}}, 
     *   operationId="get-team-members-info",
     *
     *   @OA\Parameter(
     *      name="team_id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
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
    public function getTeamMembersInfo(Request $request,$team_id):ResourceCollection
    {
      return TeamMemberResource::collection(TeamMember::where('team_id',$team_id)->orderBy('id','asc')->get());
    } 

    // public function getTeamMembersInfo(Request $request,$team_id)
    // {
    //   $team_members =  TeamMember::where('team_id',$team_id)->orderBy('id','asc')->get();
    //   $team_members_info = [];

    //   if(!empty($team_members->isNotEmpty()))
    //   {
    //     foreach ($team_members as $key => $team_member) 
    //     {
    //       $team_members_array = [];
    //       $language = Language::where('id',$team_member->language_id)->where('status','active')->first();
    //       $limit = 5;
    //       if(Auth::User()->id == 304)
    //       {
    //         $limit = 20;
    //       }
    //       $words = Word::where('status','active')->inRandomOrder()->limit($limit)->get();
    //       if(isset($language->id))
    //       {
    //         if($language->code == "ht")
    //         {
    //           $language_name = "haitianCreole";
    //         }
    //         elseif ($language->code == "ht") 
    //         {
    //           $language_name = "chinese";
    //         }
    //         else
    //         {
    //           $language_name = lcfirst($language->name);
    //         }
    //         $team_members_array['id'] = $team_member->id;
    //         $team_members_array['team_id'] = $team_member->team_id;
    //         $team_members_array['avatar_url'] = $team_member->avatar_url;
    //         $team_members_array['member_name'] = $team_member->member_name;
    //         $team_members_array['language_id'] = $team_member->language_id;
    //         $team_members_array['langauge_code'] = isset($language->code) ? $language->code : "N/A";
    //         $team_members_array['langauge_name'] = $language_name;
    //         $team_members_info[] = $team_members_array;
    //       }
    //     }
    //     return ['data' => $team_members_info,'words' => $words];
    //   }
    //   else
    //   {
    //     return ['data' => $team_members_info];
    //   }
    // } 

    /**
     * @OA\Get(
     ** path="/user/get-random-words/{plan_id}/{language_id}",
     *   tags={"User"},
     *   summary="Get Random words",
     *   security={{"bearerAuth":{}}}, 
     *   operationId="get-random-words",
     *   
        @OA\Parameter(
     *      name="plan_id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ), 
     *   @OA\Parameter(
     *      name="language_id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
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
    public function getRandomWords(Request $request):ResourceCollection
    {
      $total_words = 0;
      $plan = SubscriptionPlan::where('id',$request->plan_id)->first();
      if($plan){
        $total_words = $plan->words;
      }
      // if(in_array($request->language_id, [1,5,4,2,9,3,7]) &&  $request->plan_id == 1){
      //   return RandomWordResource::collection(Word::where(['plan_id'=>$request->plan_id,'language_id'=>$request->language_id,'status'=>'active'])->inRandomOrder()->limit($total_words)->get());
      // }
      if(in_array($request->language_id, [1,5,4,2,9,3,7]) && in_array($request->plan_id, [1,2,3,4]))
      {
        $words =  RandomWordResource::collection(Word::where(['plan_id'=>$request->plan_id,'language_id'=>$request->language_id,'status'=>'active'])->inRandomOrder()->limit($total_words)->get());
        if($words->isEmpty())
        {
          return RandomWordResource::collection(Word::where(['plan_id'=>$request->plan_id,'language_id'=>1,'status'=>'active'])->inRandomOrder()->limit($total_words)->get());
        }
        else
        {
          return $words;
        }
      }
      else
      {
        return RandomWordResource::collection(Word::where(['plan_id'=>$request->plan_id,'language_id'=>1,'status'=>'active'])->inRandomOrder()->limit($total_words)->get());
      }
      
    }

    /**
     * @OA\Post(
     ** path="/user/save-game-play",
     *   tags={"User"},
     *   summary="Save game play",
     *   security={{"bearerAuth":{}}}, 
     *   operationId="save-game-play",
     *
      @OA\RequestBody(
        @OA\MediaType(
          mediaType="application/json",
          @OA\Schema(
            collectionFormat="multi",
            @OA\Property(
              property="member_game_play",
              type="array",
              format="query",
              @OA\Items(
                @OA\Property(property="member_id", type="integer",),
                @OA\Property(
                  property="word",
                  type="array",
                  format="query",
                  @OA\Items(
                    @OA\Property(property="word_id", type="integer",),
                    @OA\Property(property="word_status", type="string",),
                    @OA\Property(property="word_time", type="string",),
                  ),
                ),
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
    public function saveGamePlay(Request $request)
    {

      if(isset($request->member_game_play) && !empty($request->member_game_play))
      {
        $member_id = '';
        foreach ($request->member_game_play as $key => $game_play) 
        {
          if(isset($game_play['member_id']) && isset($game_play['word']) && !empty($game_play['word']))
          {
            $member_id = $game_play['member_id'];
            foreach ($game_play['word'] as $key => $value) 
            {
              if(isset($value['word_status']) && isset($value['word_id']) && isset($value['word_time']) && $value['word_id'] != null && $value['word_status'] != null && $value['word_time'] != null)
              {
                $seconds = $value['word_time'] < 10 ? '0' . $value['word_time'] : $value['word_time'];
		if($seconds == 60)
                {
                  $seconds = 59;
                }
                $game = new PlayGame();
                $game->member_id = $game_play['member_id'];
                $game->word_id = $value['word_id'];
                $game->word_status = $value['word_status'];
                $game->word_time  = '00:00:'.$seconds;
                $game->save();
              }
            }
          }
        }
        $team_id = TeamMember::where('id',$member_id)->first()->team_id;
        return $this->returnResponse(true,200,'Game play saved.',$team_id);
      }
      else
      {
        return $this->returnResponse(false,400,'Game play info not get.');
      }
      
      // if(isset($request->member_id) && isset($request->word_id) && isset($request->word_status) && isset($request->word_time) && $request->member_id != null && $request->word_id != null && $request->word_status != null && $request->word_time != null)
      // {
      //   $game = new PlayGame();
      //   $game->member_id = $request->member_id;
      //   $game->word_id = $request->word_id;
      //   $game->word_status = $request->word_status;
      //   $game->word_time  = $request->word_time;
      //   $game->save();
      //   return $this->returnResponse(true,200,'Game play saved.');
      // }
      // else
      // {
      //   return $this->returnResponse(false,400,'Game play info not get.');
      // }
    }


    /**
     * @OA\Get(
     ** path="/user/leaderboard/{team_id}",
     *   tags={"User"},
     *   summary="Team Member Leaderboard",
     *   security={{"bearerAuth":{}}}, 
     *   operationId="leaderboard",
     *
     *   @OA\Parameter(
     *      name="team_id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
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
    public function leaderboard(Request $request)
    {
      if(isset($request->team_id) && $request->team_id != null)
      {
        $correct_team_members = Team::join('team_members as tm','teams.id','=','tm.team_id')
        ->join('play_games as pg','pg.member_id','=','tm.id')
        ->where('teams.id',$request->team_id)
        ->where('pg.word_status','correct')
        ->select('teams.id as t_id',
          'teams.user_id as user_id',
          'teams.game_id as game_id',
          'pg.member_id as m_id',
          'tm.member_name as member_name',
          'tm.avatar_url as avatar_url',
          // \DB::raw('SUM(TIME_TO_SEC(pg.word_time)) as `time_in_sec`'),
          \DB::raw('COUNT(pg.member_id) as count'),
          // \DB::raw('MAX(TIME_TO_SEC(pg.word_time)) as max')
        )->groupBy('pg.member_id','t_id','user_id','game_id','member_name','avatar_url','m_id')
        ->orderBy('count','desc')
        ->get()
        ->each(function ($row, $index) 
        {
          $row->rank = $index + 1;
        })
        ->toArray();

        $member_id_array = [];
        if(!empty($correct_team_members))
        {
          foreach ($correct_team_members as $key => $correct_team_member) 
          {
            $member_id_array[] = $correct_team_member['m_id'];
          }
        }

        $count = count($correct_team_members);

        $team_members = Team::join('team_members as tm','teams.id','=','tm.team_id')
        ->join('play_games as pg','pg.member_id','=','tm.id')
        ->where('teams.id',$request->team_id)
        ->whereNotIn('pg.member_id', $member_id_array)
        ->where('pg.word_status','!=','correct')
        ->select('teams.id as t_id',
        'teams.user_id as user_id',
        'teams.game_id as game_id',
        'pg.member_id as m_id',
        'tm.member_name as member_name',
        'tm.avatar_url as avatar_url',
        // \DB::raw('SUM(TIME_TO_SEC(pg.word_time)) as `time_in_sec`'),
        \DB::raw('COUNT(pg.member_id) as count'),
        // \DB::raw('MAX(TIME_TO_SEC(pg.word_time)) as max')
        )->groupBy('pg.member_id','t_id','user_id','game_id','member_name','avatar_url','m_id')
        ->orderBy('count','desc')
        ->get()
        ->each(function ($row, $index) use ($count)
        {
          $row->rank = $index + $count + 1;
        })
        ->toArray();
        $res = array_merge($correct_team_members, $team_members);

        return LeaderBoardResource::collection($res);
      }
      else
      {
        return $this->returnResponse(false,200,'Team id not get.');
      }
    }

    /**
     * @OA\Get(
     ** path="/user/subscrition-plans",
     *   tags={"User"},
     *   summary="Get Subscription plans",
     *   security={{"bearerAuth":{}}}, 
     *   operationId="subscrition-plans",
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
    public function getSubscriptionPlans(Request $request):ResourceCollection
    {
      return SubscriptionPlansResource::collection(SubscriptionPlan::where('status','active')->orderBy('id','desc')->get());
    }

    /**
     * @OA\Get(
     ** path="/user/subscrition-plan/{plan_id}",
     *   tags={"User"},
     *   summary="Get Subscription plan info",
     *   security={{"bearerAuth":{}}}, 
     *   operationId="subscrition-plan",
     *
     *   @OA\Parameter(
     *      name="plan_id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
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
    public function getSubscriptionPlanInfo(Request $request)
    {
      return new SubscriptionPlanResource(SubscriptionPlan::with('planLanguages')->where('id',$request->plan_id)->first());
    }


    /**
    @OA\Patch(
     path="/user/update-show-ad-status",
     tags={"User"},
       summary="Update Show Ad Status",
       security={{"bearerAuth":{}}}, 
       operationId="update-show-ad-status",
       
        @OA\Parameter(
          name="status",
          in="query",
          required=true,
            @OA\Schema(
                type="string"
            )
        ),
*       @OA\Examples(
*        summary="VehicleStoreEx1",
*        example = "VehicleStoreEx1",
*       value = {
*           "name": "status"
*         },
*      ),
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

    public function updateShowAdStatus(Request $request)
    {
      
      if($request->status == 'true' || $request->status == 'false')
      {   
          DB::beginTransaction();
          try 
          {
              $user = User::where('id',Auth::User()->id)->first();
              $user->show_ad = $request->status;
              $user->save();
              DB::commit();

              if($user->email == null )
              {
                $user->email = "";
              }
        
              if($user->country_code == null)
              {
                $user->country_code = "";
              }

              $plan_id = 0;
              $product_id = "";
    
              if(isset($user->subscribedUser->plan_id)){
                $plan_id = $user->subscribedUser->plan_id;
                $product_id = SubscriptionPlan::where('id',$plan_id)->first()->plan_id;
              }

              $user->plan_id = $plan_id;
              $user->product_id = $product_id;
              $data =
              [
                'id' => Auth::User()->id,
                'token' => $request->bearerToken(),
                'user'=> $user
              ];
              return $this->returnResponse(true,200,'Show ad status updated.',$data);
          }
          catch (\Exception $e) 
          {
              DB::rollback();
              return $this->returnResponse(false,200,$e->getMessage());
          }
      }
      else
      {
        return $this->returnResponse(false,200,'Please input valid status');
      }
        
    }

    private function generateUniqueGameId()
    {
      $characters = time().'0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'.time();
      $charactersNumber = strlen($characters);
      $codeLength = 6;

      $code = '';

      while (strlen($code) < 6) 
      {
        $position = rand(0, $charactersNumber - 1);
        $character = $characters[$position];
        $code = $code.$character;
      }

      if (Team::where('game_id', $code)->exists()) 
      {
        $this->generateUniqueGameId();
      }

      return $code;
    }
   
}
