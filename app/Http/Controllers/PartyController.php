<?php

namespace App\Http\Controllers;

use App\Party;
use App\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartyController extends Controller
{
    public function postAddParty(Request $request)
    {
        $this->validate($request, [
            'acronym' => 'required | max: 10',
            'name' => 'required'
        ]);

        $name = $request->name;
        $acronym = $request->acronym;
        $desc = $request->desc;

        $party = New Party();

        $party->name = $name;
        $party->acronym = $acronym;
        $party->description = $desc;

        $party->save();

        return response()->json(['message' => 'Created Successfully!']);
    }

    public static function varPartyList()
    {
        $partylist = Party::orderBy('name', 'asc')->get();
        return $partylist;
    }
}
