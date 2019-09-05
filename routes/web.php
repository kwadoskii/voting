<?php

use App\Lga;
use Illuminate\Support\Facades\Input;

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

Route::post('/adminlogin', [
        'uses' => 'AdminController@postAdminlogin',
        'as' => 'adminlogin'
]);

Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'admin'], function () {

        Route::get('dashboard', [
            'name' => 'admindashboard',
            'uses' => 'AdminController@getAdmindashboard',
            'as' => 'admindashboard'
        ]);

        Route::post('getdashdisplay', [
            'name' => 'dashdisplay',
            'uses' => 'AdminController@postGetDashDisplay'
        ]);

        Route::post('addadmin', [
            'name' => 'addadmin',
            'uses' => 'AdminController@postAddAdmin',
            'as' => 'addadmin'
        ]);

        Route::post('addstate', [
            'name' => 'addstate',
            'uses' => 'StateController@postAddState',
            'as' => 'addstate'
        ]);

        Route::post('addlga', [
            'name' => 'addlga',
            'uses' => 'StateController@postAddLga',
            'as' => 'addlga'
        ]);

        Route::get('getlgabystateid', function(){
            $stateid = Input::get('stateid');
            $lgas = Lga::where(['state_id' => $stateid])->orderBy('name', 'asc')->get();
            return $lgas;
        })->name('getlgabystateid');

        Route::post('addparty', [
            'name' => 'addparty',
            'uses' => 'PartyController@postAddParty',
            'as' => 'addparty'
        ]);

        Route::post('addvoter', [
            'name' => 'addvoter',
            'uses' => 'UserController@postAddVoter',
            'as' => 'addvoter'
        ]);

        Route::post('addoffice', [
            'name' => 'addoffice',
            'uses' => 'OfficeController@postAddOffice',
            'as' => 'addoffice'
        ]);

        Route::post('addconstituency', [
            'name' => 'addconstituency',
            'uses' => 'StateController@postAddConstituency',
            'as' => 'addconstituency'
        ]);

        Route::post('view', [
            'name' => 'view',
            'uses' => 'ViewController@viewdata',
            'as' => 'view'
        ]);

        Route::post('edit', [
            'name' => 'edit',
            'uses' => 'EditController@editData',
            'as' => 'edit'
        ]);

        Route::post('delete', [
            'name' => 'deletedata',
            'uses' => 'DeleteController@deletedata',
            'as' => 'deletedata'
        ]);

        Route::get('getlgabyid', function(){
            $stateid = Input::get('state_id');
            $lgas = Lga::where(['state_id' => $stateid, 'constituency_id' => NULL])->orderBy('name', 'asc')->get();
            return $lgas;
        })->name('getlgabyid');
    });
});

Route::get('signout', [
    'name' => 'adminlogout',
    'uses' => 'AdminController@getAdminLogout',
    'as' => 'adminlogout'
]);
