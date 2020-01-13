<?php

use App\Lga;
use App\Office;
use App\Constituency;
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

        Route::post('addcandidate', [
            'name' => 'addcandidate',
            'uses' => 'CandidateController@postAddCandidate',
            'as' => 'addcandidate'
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


        //APIs
        Route::get('getlgabyid', function(){
            $stateid = Input::get('state_id');
            $lgas = Lga::where(['state_id' => $stateid, 'constituency_id' => NULL])->orderBy('name', 'asc')->get();
            return $lgas;
        })->name('getlgabyid');

        Route::get('getconstibystate', function(){
            $stateid = Input::get('state_id');
            $consti = Constituency::where(['state_id' => $stateid])->orderBy('name', 'asc')->get();
            return $consti;
        })->name('getconstibystate');

        //for addition of candidate stateConsti
        Route::get('getavailbleparty00', function(){
            $officeid = Input::get('office_id');
            $parties = DB::select('select * from parties where acronym not in ( SELECT parties.acronym FROM users, candidates, offices, parties WHERE candidates.user_id = users.id AND candidates.office_id = offices.id AND candidates.party_id = parties.id AND candidates.office_id = :id) order by 2', ['id' => $officeid]);
            return response()->json(($parties));
        })->name('getavailbleparty00');

        Route::get('getavailbleparty10', function(){
            $officeid = Input::get('office_id');
            $stateid = Input::get('state_id');
            $parties = DB::select('select * from parties where parties.acronym not in (SELECT parties.acronym FROM users, candidates, offices, parties WHERE candidates.user_id = users.id AND candidates.office_id = offices.id AND candidates.party_id = parties.id AND candidates.office_id = :office_id and candidates.state_id = :state_id) order by 2', ['office_id' => $officeid, 'state_id' => $stateid]);
            return response()->json(($parties));
        })->name('getavailbleparty10');

        Route::get('getavailbleparty01', function(){
            $officeid = Input::get('office_id');
            $stateid = Input::get('state_id');
            $constiid = Input::get('consti_id');
            $parties = DB::select('select * from parties where parties.acronym not in (SELECT parties.acronym FROM users, candidates, offices, parties WHERE candidates.user_id = users.id AND candidates.office_id = offices.id AND candidates.party_id = parties.id AND candidates.office_id = :office_id and candidates.state_id = :state_id and candidates.consti_id = :consti_id) order by 2', ['office_id' => $officeid, 'state_id' => $stateid, 'consti_id' => $constiid]);
            return response()->json(($parties));
        })->name('getavailbleparty01');

    });
});

Route::post('/login', [
    'uses' => 'UserController@postUserLogin',
    'as' => 'login'
]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/ballot', [
        'name' => 'ballot',
        'uses' => 'BallotController@getBallot',
        'as' => 'ballot'
    ]);

    Route::group(['prefix' => 'ballot'], function () {
        Route::get('/signout', [
            'name' => 'userlogout',
            'uses' => 'UserController@postUserLogout',
            'as' => 'userlogout'
        ]);

        // Ballot APIs
        Route::get('getOfficebyId', function(){
            $officeid = Input::get('office_id');
            $candidates = DB::select("SELECT candidates.id, users.first_name, users.last_name, parties.name as 'partyname', parties.acronym,offices.name FROM candidates , offices, users, parties WHERE office_id = :office_id and offices.id = candidates.office_id and users.id = candidates.user_id and parties.id = candidates.party_id ORDER by 1", ['office_id' => $officeid]);
            return response()->json($candidates);
        });
    });
});

Route::get('signout', [
    'name' => 'adminlogout',
    'uses' => 'AdminController@getAdminLogout',
    'as' => 'adminlogout'
]);
