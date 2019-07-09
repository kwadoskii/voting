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

        ]);
    }

    public static function varPartyList()
    {
        $partylist = Party::orderBy('name', 'asc')->get();
        return $partylist;
    }
}
