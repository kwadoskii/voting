<?php

namespace App\Http\Controllers;

use App\State;
use App\Lga;
use App\Constituency;
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
            'lga' => 'required',
            'state' => 'required'
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

    public static function varConstituencyList()
    {
        $constilist = Constituency::orderBy('name', 'asc')->get();
        return $constilist;
    }

    public function postAddConstituency(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'state_id' => 'required',
            'lga_id' => 'required'
        ]);

        $name = $request->name;
        $state_id = $request->state_id;
        $lga_ids = $request->lga_id;

        $consti = New Constituency();
        $consti->name = $name;
        $consti->state_id = $state_id;
        $consti->save();

        $const_id = Constituency::where('name', $name)->pluck('id')->first();

        foreach($lga_ids as $lga_id)
        {
            $lga = Lga::find($lga_id);
            $lga->constituency_id = $const_id;
            $lga->update();
        }

        return response()->json(['message' => 'Successfully Added!'], 200);
    }
}
