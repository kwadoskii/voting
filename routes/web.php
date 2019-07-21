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
})->name('welcome');

Route::get('/admin', function () {
    return view('admin');
})->name('admin');

Route::post('/adminlogin',
    [
        'uses' => 'AdminController@postAdminlogin',
        'as' => 'adminlogin'
    ]
);

Route::get('/admin/dashboard', [
    'name' => 'admindashboard',
    'uses' => 'AdminController@getAdmindashboard',
    'as' => 'admindashboard',
    'middleware' => 'admin'
]);

Route::get('admin/signout', [
    'name' => 'adminlogout',
    'uses' => 'AdminController@getAdminLogout',
    'as' => 'adminlogout'
]);

Route::post('admin/getdashdisplay', [
    'name' => 'dashdisplay',
    'uses' => 'AdminController@postGetDashDisplay',
    'middleware' => 'admin'
]);

Route::post('admin/addadmin', [
    'name' => 'addadmin',
    'uses' => 'AdminController@postAddAdmin',
    'as' => 'addadmin',
    'middleware' => 'admin'
]);

Route::post('admin/addstate', [
    'name' => 'addstate',
    'uses' => 'StateController@postAddState',
    'as' => 'addstate',
    'middleware' => 'admin'
]);

Route::post('admin/addlga', [
    'name' => 'addlga',
    'uses' => 'StateController@postAddLga',
    'as' => 'addlga',
    'middleware' => 'admin'
]);

Route::post('admin/addparty', [
    'name' => 'addparty',
    'uses' => 'PartyController@postAddParty',
    'as' => 'addparty',
    'middleware' => 'admin'
]);

Route::post('admin/addoffice', [
    'name' => 'addoffice',
    'uses' => 'OfficeController@postAddOffice',
    'as' => 'addoffice',
    'middleware' => 'admin'
]);

Route::post('admin/id', [
    'name' => 'id',
    'uses' => 'StateController@getid',
    'as' => 'id',
    'middleware' => 'admin'
]);
