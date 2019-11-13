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

        $updatemsg = "Changes Saved!";              //notification message
        $id = $request->id;
        $update = $request->update;
        $identifier = $request->identifier;

        switch ($identifier) {
            case 'admin':
                $admin = Admin::find($id);

                if($update == 0){
                    return response()->json(['admin'=> $admin], 200);
                }
                else{
                    if(Auth::guard('admin')->user() != $admin)
                    {
                        $this->validate($request, [
                            'firstname' => 'required',
                            'lastname' => 'required',
                            'dob' => 'required',
                            'gender' => 'required',
                            'phone' => 'required',
                            'email' => 'required'
                        ]);

                        $admin->first_name = $request->firstname;
                        $admin->mid_name = $request->middlename;
                        $admin->last_name = $request->lastname;
                        $admin->DOB = $request->dob;
                        $admin->gender = $request->gender;
                        $admin->phone = $request->phone;
                        $admin->email = $request->email;

                        $admin->update();
                        return response()->json(['message' => $updatemsg], 200);
                    }
                    else{
                        $updatemsg = 'Can not edit your own details.';
                        return response()->json(['message' => $updatemsg], 200);
                    }
                }
                break;

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
                    return response()->json(['message' => $updatemsg], 200);
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
                    return response()->json(['message' => $updatemsg], 200);
                }
                break;

            case 'voter':
                $voter = User::find($id);

                if($update == 0){
                    return response()->json(['voter' => $voter], 200);
                }

                else{
                    $this->validate($request, [
                        'nin' => 'required | max: 10',
                        'firstname' => 'required',
                        'lastname' => 'required',
                        'gender' => 'required',
                        'dob' => 'required',
                        'address' => 'required',
                        'lgaid' => 'required',
                        'stateid' => 'required'
                    ]);

                    $voter->vin = $request->nin;
                    $voter->first_name = $request->firstname;
                    $voter->mid_name = $request->midname;
                    $voter->last_name = $request->lastname;
                    $voter->phone = $request->phone;
                    $voter->gender = $request->gender;
                    $voter->DOB = $request->dob;
                    $voter->address = $request->address;
                    // $voter->constituency_id = Lga::find($request->lgaid)->constituency->id;
                    $voter->lga_id = $request->lgaid;
                    $voter->state_id = $request->stateid;
                    $voter->email = $request->email;
                    $voter->update();
                    return response()->json(['message' => $updatemsg], 200);

                    // if(property_exists(Lga::find($request->lgaid)->constituency, 'id')){
                    //     return response()->json(['message' => 'LGA not assigned to a Constituency']);
                    // }
                    // else{
                    // }
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
                    return response()->json(['message' => $updatemsg], 200);
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
                    return response()->json(['message' => $updatemsg], 200);
                }

            case 'constituency':
                $constituency = Constituency::find($id);

                if($update == 0){
                return response()->json(['constituency' => ['name' => $constituency->name, 'stateid' => $constituency->state->id, 'lgasid' => $constituency->lgas]], 200);
                }
                else{
                    $this->validate($request, [
                        'name' => 'required',
                        'stateid' => 'required',
                        'lgaids' => 'required'
                    ]);

                    $constituency->name = $request->name;
                    $constituency->state_id = $request->stateid;

                    $newlgaids = $request->lgaids;                      //Eg: 10 30
                    $oldlgaids = $constituency->lgas()->pluck('id');    // Eg:10 20 30
                    // $finalids = array_diff($oldlgaids, $newlgaids);

                    foreach ($oldlgaids as $lgaid) {
                        $lga = Lga::find($lgaid);           //try and use php array diff to achieve this
                        $lga->constituency_id = null;       //and the foreach block below.
                        $lga->update();
                    }

                    foreach ($newlgaids as $lgaid) {
                        $lga = Lga::find($lgaid);
                        $lga->constituency_id = $id;
                        $lga->update();
                    }

                    $constituency->update();
                    return response()->json(['message' => $updatemsg], 200);
                }
            default:
                return response()->json(['message' => 'Data Not Found'], 422);
                break;
        }
    }
}
