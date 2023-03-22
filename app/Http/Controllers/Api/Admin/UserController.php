<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Admin\UserResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\Api\User\User;
use App\Models\Api\Admin\Word;
use App\Models\Api\Admin\Language;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    /**
    @OA\Get(
     path="/admin/user",
     tags={"Admin"},
       summary="Users Listing",
       security={{"bearerAuth":{}}}, 
       operationId="users-listing",
       
        @OA\Parameter(
          name="search",
          in="query",
          required=false,
            @OA\Schema(
                type="string"
            )
        ),
        @OA\Parameter(
          name="rows_per_page",
          in="query",
          required=false,
            @OA\Schema(
                type="int"
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
    public function index(Request $request):ResourceCollection
    {
      return UserResource::collection(User::where('role_id','!=',1)->filter($request)->orderBy('id','asc')->paginate($request->rows_per_page));
    }

    /**
    @OA\Get(
     path="/admin/counts",
     tags={"Admin"},
       summary="Dashboard Counts",
       security={{"bearerAuth":{}}}, 
       operationId="counts",
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

    public function counts()
    {
      $user_counts = User::where('role_id','!=',1)->count();
      $word_counts = Word::count();
      $language_counts = Language::count();

      $data = [];
      $data['user_counts'] =  $user_counts;
      $data['word_counts'] =  $word_counts;
      $data['language_counts'] =  $language_counts;
      return $this->returnResponse(true,200,'Users Count', $data);
    }
}
