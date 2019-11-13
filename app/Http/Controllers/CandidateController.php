<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Candidate;
use App\Party;
use App\Lga;
use App\Constituency;
use App\office;
use App\State;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidateController extends Controller
{
    public static function getCandidateList()
    {
        $candidate = Candidate::all();
        return $candidate;
    }

    public static function getOfficeList()
    {
        $office = Office::all();
        return $office;
    }

    public static function getVoterList()
    {
        $candidates = Candidate::all()->pluck('user_id');
        $voter = User::whereNotIn('id', $candidates)->get();
        // $voter = User::orderBy('first_name', 'asc')->get();
        return $voter;
    }

    public static function getStateList()
    {
        $state = State::orderBy('name', 'asc')->get();
        return $state;
    }

    public static function getPartyList()
    {
        //$party = Party::whereNotIn('id', Candidate::where('office_id', 2)->pluck('party_id'))->orderBy('name', 'asc')->get(); //use this for the dynamic candidate party
        $party = Party::orderBy('name', 'asc')->get();
        return $party;
    }

    public function postAddCandidate(Request $request)
    {
        $this->validate($request, [
            'office' => 'required',
            'candidate' => 'required',
            'party' => 'required'
        ]);

        $candidate = New Candidate();

        $candidate->user_id = $request->candidate;
        $candidate->party_id = $request->party;
        $candidate->office_id = $request->office;
        $candidate->constituency_id = $request->constituency;
        $candidate->state_id = $request->state;

        $candidate->save();

        return response()->json(['message' => 'Created Successfully!'], 200);
    }
}
