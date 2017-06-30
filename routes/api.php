<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

use Illuminate\Http\Request;

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

//Routen für API
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->get('games', 'App\Http\Controllers\Api\v1\GameController@index');
    $api->get('games/{id}', 'App\Http\Controllers\Api\v1\GameController@show');
    $api->get('games_app', 'App\Http\Controllers\Api\v1\GameController@show_app');
    $api->get('tako/filelist', 'App\Http\Controllers\Api\v1\TakoController@filelist');

    //EasyRPG Hash API
    $api->get('easyrpg', 'App\Http\Controllers\Api\v1\EasyRPGController@index');
    $api->get('easyrpg/{ldbhash}', 'App\Http\Controllers\Api\v1\EasyRPGController@show');

    $api->group(['prefix' => 'v2'], function ($api) { // Use this route group for v2

        $api->get('test', 'App\Http\Controllers\Api\v2\TestController@show');

        $api->group(['prefix' => 'auth'], function (\Dingo\Api\Routing\Router $api) {
            $api->post('login', 'App\Http\Controllers\Api\v2\AuthenticationController@login');
        });


    });
});
