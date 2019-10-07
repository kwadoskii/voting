<?php

namespace App\Http\Controllers;

use App\User;
use App\Lga;
use App\Constituency;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserController extends Controller
{
    public function postAddVoter(Request $request)
    {
        $this->validate($request, [
            'nin' => 'required | max: 10',
            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'address' => 'required',
            'lgaid' => 'required',
            'stateid' => 'required',
            'password' => 'required'
        ]);

        $voter = New User();
        $voter->vin = $request->nin;
        $voter->first_name = $request->firstname;
        $voter->mid_name = $request->midname;
        $voter->last_name = $request->lastname;
        $voter->phone = $request->phone;
        $voter->gender = $request->gender;
        $voter->DOB = $request->dob;
        $voter->address = $request->address;
        $voter->constituency_id = Lga::find($request->lgaid)->constituency->id;
        $voter->lga_id = $request->lgaid;
        $voter->state_id = $request->stateid;
        $voter->email = $request->email;
        $voter->password = bcrypt($request->password);

        $voter->save();

        return response()->json([
            'message' => 'Voter saved Successfully',
            ]);
    }

    public static function varVoterList()
    {
        $voterlist = User::orderBy('id', 'desc')->get();
        return $voterlist;
    }

    public static function varLgaList($lgaid)
    {
        $lga = Lga::find($lgaid);
        return $lga;
    }
}
