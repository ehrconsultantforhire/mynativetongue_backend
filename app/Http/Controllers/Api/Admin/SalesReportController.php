<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Admin\SalesReportResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\Api\User\UserSubscriptionPlan;
use DB;

class SalesReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

  /**
    @OA\Get(
     path="/admin/sales-report/listing",
     tags={"Admin"},
       summary="Sales Report Listing",
       security={{"bearerAuth":{}}}, 
       operationId="sales-report-listing",
       
        @OA\Parameter(
          name="month",
          in="query",
          required=false,
            @OA\Schema(
                type="string"
            )
        ),
        @OA\Parameter(
          name="year",
          in="query",
          required=false,
            @OA\Schema(
                type="string"
            )
        ),
        @OA\Parameter(
          name="type",
          in="query",
          required=true,
            @OA\Schema(
                type="string"
            )
        ),
        @OA\Parameter(
          name="rows_per_page",
          in="query",
          required=false,
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
  public function index(Request $request):ResourceCollection
  {
    $query =  UserSubscriptionPlan::orderBy('id','asc');

    if(!empty($request->month) && !empty($request->year) && $request->type == 'filter')
    {
      $from_date = $request->year.'-'.$request->month.'-'.'01';
      $to_date = $request->year.'-'.$request->month.'-'.'31';
      $query->whereBetween('created_at',[$from_date,$to_date]);
    }
    return SalesReportResource::collection($query->paginate($request->rows_per_page)); 
  }   
}
