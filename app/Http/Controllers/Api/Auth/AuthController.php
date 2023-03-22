<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginValidation;
use App\Http\Requests\User\RegisterValidation;
use App\Models\Api\User\User;
use App\Models\Api\Admin\SubscriptionPlan;
use Auth;
use Session;
use Response;
use DB;

class AuthController extends Controller
{
   
   /**
     * @OA\Post(
     ** path="/verify-user",
     *   tags={"Auth"},
     *   summary="Verify User",
     *   operationId="verify-user",
     *
     *   @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="mobile_no",
     *      in="query",
     *      required=false,
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

   public function verifyUser(Request $request)
   {
      // if(isset($request->user_id) && $request->user_id)
      // {
      //    $user = User::where(function($q) use($request)  
      //    {
      //      return $q
      //       ->where('email', $request->user_id)
      //       ->orWhere('mobile_no', $request->user_id);
      //    })->where('role_id', '=',2)->first();
      //    if(!empty($user) && isset($user->id) && $user->id)
      //    {
      //       return $this->returnResponse(true,200,'User already exist',$user);
      //    }
      //    else
      //    {
      //       return $this->returnResponse(false,404,'User does not exist.');
      //    }
      // }
      // else
      // {
      //    return $this->returnResponse(false,404,'User id empty.');
      // }

        if(!isset($request->email) && !isset($request->mobile_no))
        {
            return $this->returnResponse(false,404,'Email and Mobile no. empty.');
        }
        else
        {
            $email_user = User::where(['email'=>$request->email,'role_id'=> 2])->where('email','!=',null)->first();
            $mobile_no_user = User::where(['mobile_no'=>$request->mobile_no,'role_id' =>2])->first();

            if(isset($email_user->id) && !isset($mobile_no_user->id))
            {
                return $this->returnResponse(true,200,'This email is already being used.',$email_user);
            }
            elseif(!isset($email_user->id) && isset($mobile_no_user->id))
            {
                return $this->returnResponse(true,200,'This phone no. is already being used.',$mobile_no_user);
            }
            elseif(isset($email_user->id) && isset($mobile_no_user->id))
            {
                return $this->returnResponse(true,200,'This email and phone no. is already being used.',$mobile_no_user);
            }
            elseif(!isset($email_user->id) && !isset($mobile_no_user->id)) 
            {
                return $this->returnResponse(false,404,'Your account does not exist, please Sign Up !');
            }
        }
   }

   /**
     * @OA\Post(
     ** path="/login",
     *   tags={"Auth"},
     *   summary="Login",
     *   operationId="login",
     *
     *   @OA\Parameter(
     *      name="user_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="user_type",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
        @OA\Parameter(
     *      name="password",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
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
   
   public function login(LoginValidation $request)
   {
      if(isset($request->user_type) && $request->user_type == 'admin')
      {
         $user_details = User::where(['email'=>$request->user_id,'role_id'=>1])->first();
      }
      elseif (isset($request->user_type) && $request->user_type == 'user') 
      {
         $user_details = User::where(function($q) use($request)  
         {
           return $q
            ->where('email', $request->user_id)
            ->orWhere('mobile_no', $request->user_id);
         })->where('role_id', '=',2)->first();
      }
      
      if($user_details)
      {
        Auth::login($user_details);
        $user = Auth::User();
        $token =  $user->createToken($user->id)->accessToken; 
        if($user->email == null)
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
        'id' => $user->id,
        'token' => $token,
        'user'=>$user
        ];
        return $this->returnResponse(true,200,'You have logged In.',$data);
      }
      else
      {
         return $this->returnResponse(false,404,'User does not exist.');
      }
   }

   /**
     * @OA\Post(
     ** path="/register",
     *   tags={"Auth"},
     *   summary="Register",
     *   operationId="register",
     *
     *   @OA\Parameter(
     *      name="name",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="age",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="integer"
     *      )
     *   ),
         @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
         @OA\Parameter(
     *      name="country_code",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
         @OA\Parameter(
     *      name="mobile_no",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
         @OA\Parameter(
     *      name="role_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="integer"
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *    @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *    @OA\Response(
     *          response=404,
     *          description="Not Found",
     *      ),
     *)
     **/

   public function register(RegisterValidation $request)
   {  
      DB::beginTransaction();
      try 
      {
         $user = new User();
         $user->name = $request->name != null ? $request->name : "";
         $user->age = $request->age != null ? (int)$request->age : 0 ;
         $user->email = $request->email != null ? $request->email : null;
         $user->country_code = $request->country_code;
         $user->mobile_no = $request->mobile_no;
         $user->role_id = (int)$request->role_id;
         $user->status = 'active';
         $user->is_subscribed = 'false';
         $user->save();
         if(isset($user->id) && $user)
         {
            if($request->email == "")
            {
              $user->email = "";
            }

            if($request->country_code == "")
            {
              $user->country_code = "";
            }

            DB::commit();
            Auth::login($user);
            $auth_user = Auth::User();
            $token =  $auth_user->createToken($user->id)->accessToken; 
            $user->plan_id = 0;
            $user->product_id = "";
            $data =
            [
            'id' => $user->id,
            'token' => $token,
            'user'=>$user
            ];
            return $this->returnResponse(true,200,'You have signed up. ',$data);
         }
         else
         {
            DB::rollback();
            return $this->returnResponse(false,404,'User not Registered.');
         }
      }
      catch (\Exception $e) 
      {
         DB::rollback();
         return $this->returnResponse(false,200,$e->getMessage());
      }
   }

   /**
     * @OA\Post(
     ** path="/logout",
     *   tags={"Auth"},
     *   summary="Logout",
      *  security={{"bearerAuth":{}}}, 
     *   operationId="logout",

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
     *      ),
     *    @OA\Response(
     *          response=404,
     *          description="Not Found",
     *      ),
     *)
     **/

    public function logout()
    {
      if (Auth::check()) 
      {
       $user = Auth::user()->token();
       $user->revoke();
       return $this->returnResponse(true,200,'User Logged Out Successfully!!');
      }
      else
      {
       return $this->returnResponse(true,404,'User not Logged In.');
      }
    }
}
