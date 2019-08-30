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
            'name' => 'required'
        ]);

        $name = $request['name'];
        $consti = $request['consti'];
        $state = $request['state'];

        $office = New Office();

        $office->name = $name;
        $office->is_constituency = $consti;
        $office->is_state = $state;
        $office->save();

        return response()->json(['message' => 'Created Successfully!']);
    }

    public static function varVoterList()
    {
        $voterlist = User::orderBy('id', 'desc')->get();
        return $voterlist;
    }
}
