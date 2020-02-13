<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Result;
use App\Lga;
use DB;
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
            return response()->json(['message' => 'You Voted in this Category'], 201);
        } else {
            if ($result->save()) {
                return response()->json(['message' => 'Voted Successfully'], 200);
            } else {
                return response()->json(['message' => 'An error occured'], 201);
            }
        }
    }

    public function countVotes(Request $request)
    {
        $this->validate($request, [
            'isstate' => 'required',
            'isconsti' => 'required',
            'office_id' => 'required'
        ]);

        if($request->isstate == 0 && $request->isconsti == 0)
        {
            $results = DB::select("SELECT parties.acronym, users.first_name, users.mid_name, users.last_name, count(parties.acronym) as polls, offices.name as office, users.gender as gender FROM results, offices, parties, lgas, constituencies, states, users, candidates where results.office_id = offices.id and parties.id = results.party_id and lgas.id = results.lga_id AND constituencies.id = results.consti_id and states.id = results.state_id AND candidates.id = results.candi_id AND users.id = candidates.user_id and results.office_id = :office_id GROUP by parties.acronym order by polls DESC", ['office_id' => $request->office_id]);

            return response()->json(['message' => $results], 200);
        }

        if($request->isstate == 1 && $request->isconsti == 0)
        {
            $this->validate($request, [
                'state_id' => 'required'
            ]);

            $results = DB::select("SELECT parties.acronym, users.first_name, users.mid_name, users.last_name, count(parties.acronym) as polls, offices.name as office, users.gender as gender FROM `results`, offices, parties, lgas, constituencies, states, users, candidates where results.office_id = offices.id and parties.id = results.party_id and lgas.id = results.lga_id AND constituencies.id = results.consti_id and states.id = results.state_id AND candidates.id = results.candi_id AND users.id = candidates.user_id and results.office_id = :office_id and results.state_id = :state_id GROUP by parties.acronym order by 5 DESC", ['office_id' => $request->office_id, 'state_id' => $request->state_id]);

            return response()->json(['message' => $results], 200);
        }

        if($request->isstate == 0 && $request->isconsti == 1)
        {
            $this->validate($request, [
                'state_id' => 'required',
                'consti_id' => 'required'
            ]);

            $results = DB::select("SELECT parties.acronym, users.first_name, users.mid_name, users.last_name, count(parties.acronym) as polls, offices.name as office, users.gender as gender FROM `results`, offices, parties, lgas, constituencies, states, users, candidates where results.office_id = offices.id and parties.id = results.party_id and lgas.id = results.lga_id AND constituencies.id = results.consti_id and states.id = results.state_id AND candidates.id = results.candi_id AND users.id = candidates.user_id and results.office_id = :office_id and results.state_id = :state_id and results.consti_id = :consti_id GROUP by parties.acronym order by 5 DESC", ['office_id' => $request->office_id, 'state_id' => $request->state_id, 'consti_id' => $request->consti_id]);

            return response()->json(['message' => $results], 200);
        }
    }
}
