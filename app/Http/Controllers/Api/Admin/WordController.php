<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Admin\WordResource;
use App\Http\Resources\Admin\LanguageResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\Api\Admin\Word;
use App\Models\Api\Admin\WordTranslation;
use App\Models\Api\Admin\Language;
use App\Http\Requests\Admin\Word\CreateValidation;
use App\Http\Requests\Admin\Word\EditValidation;
use DB;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Models\Api\Admin\SubscriptionPlan;
use App\Http\Resources\User\SubscriptionPlansResource;


class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
    @OA\Get(
     path="/admin/word",
     tags={"Admin"},
       summary="Words Listing",
       security={{"bearerAuth":{}}}, 
       operationId="words-listing",
       
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
    public function index(Request $request)
    {
        $query =  Word::filter($request)->orderBy('id','desc');

        if(!empty($request->plan_id) && !empty($request->language_id)){
        $query->where(['plan_id'=>$request->plan_id,'language_id'=>$request->language_id]);
        }elseif(empty($request->language_id) && !empty($request->plan_id)){
        $query->where(['plan_id'=>$request->plan_id]);
        }elseif(!empty($request->language_id) && empty($request->plan_id)){
        $query->where(['language_id'=>$request->language_id]);
        }
        

        return WordResource::collection($query->paginate($request->rows_per_page));
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
     path="/admin/word",
     tags={"Admin"},
       summary="Add Word",
       security={{"bearerAuth":{}}}, 
       operationId="add-word",
       
        @OA\Parameter(
          name="word",
          in="query",
          required=true,
            @OA\Schema(
                type="string"
            )
        ),
        @OA\Parameter(
          name="plan_id",
          in="query",
          required=true,
            @OA\Schema(
                type="integer"
            )
        ),
        @OA\Parameter(
          name="language_id",
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
    public function store(CreateValidation $request)
    {
        $word = new Word();
           
        DB::beginTransaction();
        try 
        {
            $word->word = $request->word;
            $word->plan_id = $request->plan_id;
            $word->language_id = $request->language_id;
            $word->save();

            // $languages = Language::where('status','active')->get();
            // if(!empty($languages))
            // {
            //   foreach ($languages as $key => $language) 
            //   {
            //     $word_translation = new WordTranslation();
            //     if($language && isset($language->code))
            //     {
            //       $translate = new GoogleTranslate();
            //       $translate->setSource('en');
            //       $translate->setTarget($language->code);
            //       $translated_word = $translate->translate($request->word);

            //       $word_translation->plan_id = $request->plan_id;
            //       $word_translation->word_id = $word->id;
            //       $word_translation->language_id = $language->id;
            //       $word_translation->word = $translated_word;
            //       $word_translation->save();
            //     }
            //   }
            // }

            if(isset($word->id) && $word)
            {
                DB::commit();
                return $this->returnResponse(true,200,'Word created.');
            }
            else
            {
                DB::rollback();
                return $this->returnResponse(false,200,'Word not create.');
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
     path="/admin/word/{word_id}",
     tags={"Admin"},
       summary="Show Word",
       security={{"bearerAuth":{}}}, 
       operationId="show-word",
       
        @OA\Parameter(
          name="word_id",
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
        $word = new WordResource(Word::find($id));
        return $this->returnResponse(true,200,'Word', $word);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
     path="/admin/word/{word_id}",
     tags={"Admin"},
       summary="Edit Word",
       security={{"bearerAuth":{}}}, 
       operationId="edit-word",
       
        @OA\Parameter(
          name="word_id",
          in="path",
          required=true,
            @OA\Schema(
                type="integer"
            )
        ),
        @OA\Parameter(
          name="word",
          in="query",
          required=true,
            @OA\Schema(
                type="string"
            )
        ),
        @OA\Parameter(
          name="plan_id",
          in="query",
          required=true,
            @OA\Schema(
                type="integer"
            )
        ),
        @OA\Parameter(
          name="language_id",
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
    public function update(EditValidation $request, $id)
    {
        $word = Word::where('id',$id)->first();
        // $old_word = $word->id;
        // $old_plan_id = $word->plan_id;
        if($word)
        {   
            DB::beginTransaction();
            try 
            {
                $word->word = $request->word;
                $word->plan_id = $request->plan_id;
                $word->language_id = $request->language_id;
                $word->save();
              
                // if($old_word != $request->word || $old_plan_id != (int)$request->plan_id)
                // {
                //   $languages = Language::where('status','active')->get();
                //   if(!empty($languages))
                //   {
                //     WordTranslation::where('word_id',$id)->delete();
                //     foreach ($languages as $key => $language) 
                //     {
                //       $word_translation = new WordTranslation();
                //       if($language && isset($language->code))
                //       {
                //         $translate = new GoogleTranslate();
                //         $translate->setSource('en');
                //         $translate->setTarget($language->code);
                //         $translated_word = $translate->translate($request->word);

                //         $word_translation->plan_id = $request->plan_id;
                //         $word_translation->word_id = $word->id;
                //         $word_translation->language_id = $language->id;
                //         $word_translation->word = $translated_word;
                //         $word_translation->save();
                //       }
                //     }
                //   }
                // }
                DB::commit();
                return $this->returnResponse(true,200,'Word updated.');
            }
            catch (\Exception $e) 
            {
                DB::rollback();
                return $this->returnResponse(false,200,$e->getMessage());
            }
        }
        else
        {
            return $this->returnResponse(false,200,'Word not found');
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
     path="/admin/word/{word_id}",
     tags={"Admin"},
       summary="Delete Word",
       security={{"bearerAuth":{}}}, 
       operationId="delete-word",
       
        @OA\Parameter(
          name="word_id",
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
        $word = Word::find($id);
        if($word)
        {
            $word->delete();
            return $this->returnResponse(true,200,'Word deleted.');
        }
        else
        {
            return $this->returnResponse(false,200,'Word not found.');
        }
    }

    /**
    @OA\Post(
     path="/admin/word/update-status",
     tags={"Admin"},
       summary="Update Word Status",
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
            $word = Word::find($request->id);
            if($word)
            {   
                DB::beginTransaction();
                try 
                {
                    $word->status = $request->status;
                    $word->save();
                    DB::commit();
                    return $this->returnResponse(true,200,'Status updated.',$word);
                }
                catch (\Exception $e) 
                {
                    DB::rollback();
                    return $this->returnResponse(false,200,$e->getMessage());
                }
            }
            else
            {
                return $this->returnResponse(false,200,'Word not found');
            }
        }
        else
        {
            return $this->returnResponse(false,200,'Word id empty.');
        }
    }

    /**
    @OA\Get(
     path="/admin/word/plans-list",
     tags={"Admin"},
       summary="Plans Listing",
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

    public function plansList(Request $request):ResourceCollection
    {
      return SubscriptionPlansResource::collection(SubscriptionPlan::where('status','active')->orderBy('id','desc')->get());
    }

    /**
    @OA\Get(
     path="/admin/word/langs-list/{plan_id}",
     tags={"Admin"},
       summary="Languages Listing",
       security={{"bearerAuth":{}}}, 
       operationId="langs-listing",
        
        @OA\Parameter(
          name="plan_id",
          in="path",
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

    public function langsList(Request $request):ResourceCollection
    {
      $plan_id = $request->plan_id;
      return LanguageResource::collection(Language::whereHas('subscriptionPlanLanguage',function($q)  use($plan_id){
        $q->where(['plan_id'=> $plan_id,'status'=> 'active']);
      })->where('status','active')->orderBy('id','asc')->get());
    }
}
