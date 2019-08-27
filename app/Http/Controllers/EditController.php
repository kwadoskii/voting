<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Candidate;
use App\Party;
use App\Constituency;
use App\Lga;
use App\Office;
use App\State;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditController extends Controller
{
    public function editData(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'identifier' => 'required',
            'update' => 'required'
        ]);

        $id = $request->id;
        $update = $request->update;
        $identifier = $request->identifier;

        switch ($identifier) {
            case 'state':
                $state = State::find($id);

                if($update == 0){
                    return response()->json(['state'=> $state], 200);
                }
                else{
                    $this->validate($request, [
                        'name' => 'required'
                    ]);
                    $state->name = $request->name;
                    $state->update();
                    return response()->json(['message' => "Updated Successfully!"], 200);
                }
                break;

            case 'lga':
                $lga = Lga::find($id);

                if($update == 0){
                    return response()->json(['lga' => $lga, 'stateid' => $lga->state->id], 200);
                }
                else{
                    $this->validate($request, [
                        'name' => 'required',
                        'stateid' => 'required'
                    ]);

                    $lga->name = $request->name;
                    $lga->state_id = $request->stateid;
                    $lga->constituency_id = null;
                    $lga->update();
                    return response()->json(['message' => "Updated Successfully!"], 200);
                }
                break;

            case 'party':
                $party = Party::find($id);

                if($update == 0){
                    return response()->json(['party' => $party], 200);
                }
                else{
                    $this->validate($request, [
                        'name' => 'required',
                        'acronym' => 'required',
                        'desc' => 'required'
                    ]);

                    $party->name = $request->name;
                    $party->acronym = $request->acronym;
                    $party->description = $request->desc;
                    $party->update();
                    return response()->json(['message' => "Updated Successfully!"], 200);
                }

            case 'office':
                $office = Office::find($id);

                if($update == 0){
                return response()->json(['office' => $office], 200);
                }
                else{
                    $this->validate($request, [
                        'name' => 'required',
                        'is_state' => 'required',
                        'is_constituency' => 'required'
                    ]);

                    $office->name = $request->name;
                    $office->is_state = $request->is_state;
                    $office->is_constituency = $request->is_constituency;
                    $office->update();
                    return response()->json(['message' => "Updated Successfully!"], 200);
                }

            case 'constituency':
                $constituency = Constituency::find($id);

                if($update == 0){
                return response()->json(['constituency' => ['name' => $constituency->name, 'stateid' => $constituency->state->id, 'lgasid' => $constituency->lgas]], 200);
                }
                else{
                    //
                }
            default:
                return response()->json(['message' => 'Data Not Found'], 422);
                break;
        }
    }
}
