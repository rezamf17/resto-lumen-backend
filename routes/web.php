<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that UR
I is requested.
|
*/

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });
// $router->get('/key', function() {
//     return \Illuminate\Support\Str::random(32);
// });
$router->get('/menu', 'MenuController@index');
$router->get('/category', 'CategoryController@index');
$router->post('/orders', 'OrderController@storeOrder');
$router->post('customers', 'CustomerController@storeCustomer');
$router->group([
    'prefix' => 'api'
], function () use ($router) {
   // Matches "/api/register
   $router->post('register', 'AuthController@register');
   $router->post('login', 'AuthController@login');
   $router->put('refresh', 'AuthController@refresh');
   $router->post('logout', 'AuthController@logout');
   $router->get('profile', 'UserController@profile');
   $router->put('profile/{id}', 'UserController@editProfile');
   $router->post('changeImage', 'UserController@changeImage');
   $router->post('addAccount', 'UserController@addUser');
   $router->put('editAccount/{id}', 'UserController@editUser');
   $router->delete('deleteAccount/{id}', 'UserController@deleteUser');
    // Matches "/api/users/1 
    //get one user by id
    $router->get('users/{id}', 'UserController@singleUser');

    // Matches "/api/users
    $router->get('allMenu', 'MenuController@index');
    $router->get('/allCategory', 'CategoryController@index');
    $router->get('count-menu', 'MenuController@countMenu');
    $router->get('users', 'UserController@allUsers');
    $router->post('addMenu', 'MenuController@addMenu');
    $router->put('editMenu/{id}', 'MenuController@editMenu');
    $router->delete('deleteMenu/{id}', 'MenuController@deleteMenu');
    $router->post('addCategory', 'CategoryController@addCategory');
    $router->get('count-category', 'CategoryController@countCategory');
    $router->put('editCategory/{id}', 'CategoryController@editCategory');
    $router->delete('deleteCategory/{id}', 'CategoryController@deleteCategory');

    //orders & customer
    $router->get('getOrders', 'OrderController@getOrder');
    $router->get('pdfOrders/{id}', 'OrderController@pdfOrder');
    $router->get('count-order', 'OrderController@countOrder');
    $router->get('getDetailOrder/{id}', 'OrderController@getDetailOrder');
    $router->get('getCustomers', 'CustomerController@getCustomer');
    $router->get('count-customer', 'CustomerController@countCustomer');
    $router->delete('deleteCustomers/{id}', 'CustomerController@deleteCustomer');

});
