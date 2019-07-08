<?php

namespace App\Http\Controllers;

use App\State;
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

        return response()->json(['message' => 'Save Successfully!'], 200);
    }

    public static function varStateList()
    {
        $statelist = State::orderBy('name', 'asc')->get();
        return $statelist;
    }
}
