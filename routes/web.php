<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () 
{ 
	return view('welcome'); 
});

// Route::group(['middleware' => ['guest']], function() 
// {
//   Route::get('admin', function () { return view('admin.login'); })->name('admin');
//   Route::post('login','UserController@login');
// });

// Route::group(['middleware' => ['auth:web']], function() 
// {
// 	Route::group(['prefix' => 'admin', 'middleware' => ['admin']],function()
// 	{
// 	    Route::get('{slug}', 'AdminController@index');
// 	});

// 	Route::get('logout','UserController@logout'); 
// });

// Route::any('{query}', 
//   function() 
//   {
//     if(Auth::User() && Auth::User()->role_id == '1')
//     {
//     	return redirect('admin/dashboard');
//     }
//     else
//     {
//     	dd('Under Process');
//     }
//   })
//   ->where('query', '.*');
