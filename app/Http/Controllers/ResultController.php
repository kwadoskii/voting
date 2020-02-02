<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Result;
use App\Lga;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function vote(Request $request)
    {

        $result = new Result();
        $result['candi_id'] = $request->candidate_id;
        $result['office_id'] = $request->office_id;
        $result['party_id'] = $request->party_id;
        $result['lga_id'] = Auth::user()->lga_id;
        $result['consti_id'] = Lga::find(Auth::user()->lga_id)->constituency->id;
        $result['state_id'] = Auth::user()->state_id;
        $result['user_id'] = Auth::user()->id;

        $incomingvote = [];
        $dbvote = [];

        $incomingvote['office_id'] = $request->office_id;
        $dbvote['user_id'] = Auth::user()->id;
        $incomingvote['user_id'] = $dbvote['user_id'];
        $dbvote['office_id'] = 0;

        $votes = Result::where('user_id', $dbvote['user_id'])->get();
        foreach ($votes as $vote) {
            if ($vote->office_id == $incomingvote['office_id']) {
                $dbvote['office_id'] = $incomingvote['office_id'];
            }
        }

        if ($dbvote == $incomingvote) {
            return response()->json(['message' => 'You Voted for this Category'], 201);
        } else {
            if ($result->save()) {
                return response()->json(['message' => 'Voted Successfully'], 200);
            } else {
                return response()->json(['message' => 'An error occured'], 201);
            }
        }
    }
}
