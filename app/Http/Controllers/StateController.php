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

    public static function varLgaList()
    {
        $lgalist = Lga::orderBy('state_id', 'asc')->get();
        return $lgalist;
    }
}
