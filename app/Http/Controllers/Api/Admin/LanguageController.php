<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Admin\LanguageResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\Api\Admin\Language;
use App\Http\Requests\Admin\Language\CreateValidation;
use App\Http\Requests\Admin\Language\EditValidation;
use DB;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    /**
    @OA\Get(
     path="/admin/language",
     tags={"Admin"},
       summary="Languages Listing",
       security={{"bearerAuth":{}}}, 
       operationId="languages-listing",
       
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
        return LanguageResource::collection(Language::filter($request)->orderBy('id','asc')->paginate($request->rows_per_page));
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

    /**
    @OA\Post(
     path="/admin/language",
     tags={"Admin"},
       summary="Add Language",
       security={{"bearerAuth":{}}}, 
       operationId="add-language",
       
        @OA\Parameter(
          name="code",
          in="query",
          required=true,
            @OA\Schema(
                type="string"
            )
        ),
         @OA\Parameter(
          name="name",
          in="query",
          required=true,
            @OA\Schema(
                type="string"
            )
        ),
         @OA\Parameter(
          name="native_name",
          in="query",
          required=true,
            @OA\Schema(
                type="string"
            )
        ),
         @OA\Parameter(
          name="status",
          in="query",
          required=true,
            @OA\Schema(
                type="string"
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
    public function store(CreateValidation $request)
    {
        $language = new Language();
           
        DB::beginTransaction();
        try 
        {
            $language->code = $request->code;
            $language->name = $request->name;
            $language->native_name = $request->native_name;
            $language->status = $request->status;
            $language->save();

            if(isset($language->id) && $language)
            {
                DB::commit();
                return $this->returnResponse(true,200,'Language created.',$language);
            }
            else
            {
                DB::rollback();
                return $this->returnResponse(false,200,'Language not create.');
            }
        }
        catch (\Exception $e) 
        {
            DB::rollback();
            return $this->returnResponse(false,200,$e->getMessage());
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
    @OA\Get(
     path="/admin/language/{language_id}",
     tags={"Admin"},
       summary="Show Language",
       security={{"bearerAuth":{}}}, 
       operationId="show-language",
       
        @OA\Parameter(
          name="language_id",
          in="path",
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
    public function show($id)
    {
        $language = new LanguageResource(Language::find($id));
        return $this->returnResponse(true,200,'Language', $language);
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
    @OA\Patch(
     path="/admin/language/{language_id}",
     tags={"Admin"},
       summary="Edit Language",
       security={{"bearerAuth":{}}}, 
       operationId="edit-language",
       
        @OA\Parameter(
          name="language_id",
          in="path",
          required=true,
            @OA\Schema(
                type="integer"
            )
        ),
        @OA\Parameter(
          name="code",
          in="query",
          required=true,
            @OA\Schema(
                type="string"
            )
        ),
        @OA\Parameter(
          name="name",
          in="query",
          required=true,
            @OA\Schema(
                type="string"
            )
        ),
        @OA\Parameter(
          name="native_name",
          in="query",
          required=true,
            @OA\Schema(
                type="string"
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
    public function update(EditValidation $request, $id)
    {
        $language = Language::find($id);
        if($language)
        {   
            DB::beginTransaction();
            try 
            {
                $language->code = $request->code;
                $language->name = $request->name;
                $language->native_name = $request->native_name;
                $language->save();
                DB::commit();
                return $this->returnResponse(true,200,'Language updated.',$language);
            }
            catch (\Exception $e) 
            {
                DB::rollback();
                return $this->returnResponse(false,200,$e->getMessage());
            }
        }
        else
        {
            return $this->returnResponse(false,200,'Language not found');
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /**
    @OA\Delete(
     path="/admin/language/{language_id}",
     tags={"Admin"},
       summary="Delete Language",
       security={{"bearerAuth":{}}}, 
       operationId="delete-language",
       
        @OA\Parameter(
          name="language_id",
          in="path",
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
    public function destroy($id)
    {
        $language = Language::find($id);
        if($language)
        {
            $language->delete();
            return $this->returnResponse(true,200,'Language deleted.');
        }
        else
        {
            return $this->returnResponse(false,200,'Language not found.');
        }
    }

    /**
    @OA\Post(
     path="/admin/language/update-status",
     tags={"Admin"},
       summary="Update language Status",
       security={{"bearerAuth":{}}}, 
       operationId="update-status",
       
        @OA\Parameter(
          name="id",
          in="query",
          required=true,
            @OA\Schema(
                type="integer"
            )
        ),
        @OA\Parameter(
          name="status",
          in="query",
          required=true,
            @OA\Schema(
                type="string"
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
    public function updateStatus(Request $request)
    {
        if(isset($request->id) && $request->id)
        {
            $language = Language::find($request->id);
            if($language)
            {   
                DB::beginTransaction();
                try 
                {
                    $language->status = $request->status;
                    $language->save();
                    DB::commit();
                    return $this->returnResponse(true,200,'Status updated.',$language);
                }
                catch (\Exception $e) 
                {
                    DB::rollback();
                    return $this->returnResponse(false,200,$e->getMessage());
                }
            }
            else
            {
                return $this->returnResponse(false,200,'Language not found');
            }
        }
        else
        {
            return $this->returnResponse(false,200,'Language id empty.');
        }
    }
}
