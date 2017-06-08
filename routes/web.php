<?php

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

Route::get('/', function () {
    return view('welcome');
});
$api = app('Dingo\Api\Routing\Router');
$api->group(["version"=>"v1",'middleware' => ["bindings"], 'providers' => 'jwt'], function ($api) {
  $api->resource('users', 'App\Http\Controllers\UserController', ["except"=>["store"]]);
  $api->resource('jobs', 'App\Http\Controllers\JobController');
  $api->get('/me', 'App\Http\Controllers\AuthController@me');
});
$api->group(["version"=>"v1",'middleware' => ["bindings"]], function ($api) {
    $api->get("/",function(){
      return "HI";
    });
    $api->post('/auth', 'App\Http\Controllers\AuthController@authenticate');
    $api->post('/auth/refresh', 'App\Http\Controllers\AuthController@refresh');
    $api->post("/users", [ "as"=>"users.store" , "uses" => "App\Http\Controllers\UserController@store"]);
});
