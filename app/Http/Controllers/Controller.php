<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
	/**
     * @OA\Info(
     *      version="1.0.0",
     *      title="MNT",
     * ),
    *     @OA\SecurityScheme(
    *      securityScheme="bearerAuth",
    *      in="header",
    *      name="bearerAuth",
    *      type="http",
    *      scheme="bearer",
    *      bearerFormat="JWT",
    * ),
     *
     *
     *
     */

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function returnResponse($status=false,$code=200,$message="", $data=[],$action="",$errors=[])
	{
		return response()->json([
		                   'status'  => $status,
		                   'code'    => $code,
		                   'action'  => $action,
		                   'message' => $message,
		                   'errors'  => $errors,
		                   'data'    => $data,
		               ], $code);
	}
}
