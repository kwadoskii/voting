<?php

namespace App\Http\Controllers;

use App\State;
use App\Lga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StateController extends Controller
{
    public function postAddState(Request $request)
    {
        $this->validate($request, [
            'state' => 'required'
        ]);

        $name = $request->state;

        $state = New State();

        $state->name = $name;
        $state->save();

        return response()->json(['message' => 'Saved Successfully!'], 200);
    }

    public function postAddLga(Request $request)
    {
        $this->validate($request, [
            'lga' => 'required'
        ]);

        $name = $request->lga;
        $state = $request->state;

        $lga = New Lga();

        $lga->name = $name;
        $lga->state_id = $state;

        $lga->save();

        return response()->json(['message' => 'Saved Successfully'], 200);
    }

    public static function varStateList()
    {
        $statelist = State::orderBy('name', 'asc')->get();
        return $statelist;
    }

    public $idd = '';

    public static function getid2()
    {
        global $idd;
        // return  ;
        return $idd;
    }

    public static function getid(Request $request)
    {
        // global $idd;
        $id = $request['id'];
        $GLOBALS['idd']  = $id;

        return response()->json();
        // Use with and redirect back to the calling page;
    }

    public static function varstate(Request $id)
    {
        // global $id;
        // $id = State::find($id);
        // return respnse()->json([], 200);
    }

    public static function varLgaList()
    {
        $lgalist = Lga::orderBy('state_id', 'asc')->get();
        return $lgalist;
    }
}
