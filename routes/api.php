<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Api\User\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['namespace' => 'Api\Auth', 'middleware' => ['guest']], function() 
{
	Route::get('logout', function (Request $request) 
	{
	    return response()->json([
			"status"=> false,
			"code"=> 200,
			"action" =>  "",
			"message" =>  "User not Logged In.",
			"errors" =>  [],
			"data" =>  [],
	    ], 200);
	})->name('logout');

	// Route::get('delete-testing-user', function (Request $request) 
	// {
	//     $testing_user = User::where('mobile_no','+915555555555')->first();
	//     if(isset($testing_user->id))
	//     {
	//     	$testing_user->delete();
	//     	return response()->json([
	// 		"message" =>  "User deleted.",
	//     	], 200);
	//     }
	//     else
	//     {
	//     	return response()->json([
	// 		"message" =>  "User not exist.",
	//     	], 200);
	//     }
	    
	// });

  	Route::post('login','AuthController@login');
  	Route::post('register','AuthController@register');
  	Route::post('verify-user','AuthController@verifyUser');
  
});

Route::middleware('auth:api')->group(function () 
{
	Route::group(['namespace' => 'Api\Admin', 'prefix' => 'admin', 'middleware' => ['admin']],function()
	{
	    Route::post('language/update-status', 'LanguageController@updateStatus');
	    Route::resource('language', 'LanguageController');
	    Route::post('word/update-status', 'WordController@updateStatus');
	    Route::get('word/plans-list', 'WordController@plansList');
	    Route::get('word/langs-list/{plan_id}', 'WordController@langsList');
	    Route::resource('word', 'WordController');
	    Route::get('counts', 'UserController@counts');
	    Route::resource('user', 'UserController');
	    Route::resource('subscription-plan', 'SubscriptionPlanController');
	    Route::get('sales-report/listing', 'SalesReportController@index');
	    Route::get('analytics', 'AnalyticsController@index');
	});

	Route::group(['namespace' => 'Api\User', 'prefix' => 'user', 'middleware' => ['user']],function()
	{
	    Route::get('language-list', 'GameController@languageList');

	    Route::get('avatar-list', 'GameController@avatarList');

	    Route::post('save-team-members-info', 'GameController@saveTeamMembersInfo');
	    Route::get('get-team-members-info/{team_id}', 'GameController@getTeamMembersInfo');
	    Route::post('delete-team-members-info', 'GameController@deleteTeamMembersInfo');

	    Route::get('get-random-words/{plan_id}/{language_id}', 'GameController@getRandomWords');

	    Route::post('save-game-play', 'GameController@saveGamePlay');

	    Route::get('leaderboard/{team_id}', 'GameController@leaderboard');

	    Route::post('assign-subscription-plan', 'SubscriptionController@assignSubscriptionPlan');

	    Route::get('subscrition-plan/{plan_id}', 'GameController@getSubscriptionPlanInfo');
	    Route::get('subscrition-plans', 'GameController@getSubscriptionPlans');

	    Route::post('assign-plan', 'SubscriptionController@assignSubscriptionPlan');
	    Route::patch('update-show-ad-status', 'GameController@updateShowAdStatus');

	});

    Route::post('logout', 'Api\Auth\AuthController@logout');
});
