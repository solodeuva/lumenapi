<?php
//use Illuminate\Support\Str;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

/*$router->get('/key', function() {
    return Str::random(32);
});*/


// API route group
$router->group(['prefix' => 'api'], function () use ($router) {
   // Matches "/api/register
   
   	$router->group(['middleware' => ['auth']], function () use ($router) {
	   // Matches "/api/register
	   $router->get('list', 'ExampleController@usuarios');
	});

   // Matches "/api/login
    $router->post('login', 'AuthController@login');

});
