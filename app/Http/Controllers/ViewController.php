<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Candidate;
use App\Party;
use App\Constituency;
use App\Lga;
use App\office;
use App\State;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{
    public static function viewdata(Request $request)
    {
        $id = $request['id'];
        $identifier = $request['identifier'];

        switch ($identifier) {
            case 'state':
                $data = State::find($id);
                return response()->json(['state' => $data]);
                break;

            case 'lga':
                $data = Lga::find($id);
                return response()->json(['lga' => [
                    'name' => $data->name,
                    'state' => $data->state->name
                ]]);
                break;

            case 'office':
                $data = Office::find($id);
                return response()->json(['office' => [
                    'name' => $data->name,
                    'state' => $data->is_state,
                    'consti' => $data->is_constituency
                ]]);
                break;

            case 'party':
                $data = Party::find($id);
                return response()->json(['party' => [
                    'name' => $data->name,
                    'acronym' => $data->acronym,
                    'desc' => $data->description
                ]]);
                break;

            case 'admin':
                $data = Admin::find($id);
                return response()->json(['admin' => [
                    'firstname' => $data->first_name,
                    'midname' => $data->mid_name,
                    'lastname' => $data->last_name,
                    'phone' => $data->phone,
                    'gender' => $data->gender,
                    'dob' => $data->DOB,
                    'email' => $data->email
                ]]);
                break;

            case 'constituency':
                $data = Constituency::find($id);
                return response()->json(['constituency' => [
                    'name' => $data->name,
                    'state' =>$data->state->name,
                    'lgas' => $data->lgas()->pluck('name')
                ]]);
                break;

                case 'voter':
                $data = User::find($id);
                $data->state = State::find($data->state_id)->name;
                $data->lga = Lga::find($data->lga_id)->name;
                if(Lga::find($data->lga_id)->constituency != null){
                    $data->consti = Lga::find($data->lga_id)->constituency->name;
                }
                return response()->json(['voter' => $data]);
                break;

            case 'candidate':
                $data = Candidate::find($id);
                $rdata = [];
                $rdata['office'] = $data->office->name;
                $rdata['first_name'] = $data->user->first_name;
                $rdata['mid_name'] = $data->user->mid_name;
                $rdata['last_name'] = $data->user->last_name;
                $rdata['gender'] = $data->user->gender;
                // $rdata['state'] = State::find($data->user->state_id)->name;
                // $rdata['consti'] = Lga::find($data->user->lga_id)->constituency->name;
                $rdata['age'] = date('Y') - date('Y', strtotime($data->user->DOB)) ;
                $rdata['party'] = $data->party->acronym;
                return response()->json(['candidate' => $rdata], 200);
                break;

            default:
                return response()->json(['message' => 'Data Not Found']);
                break;
        }
        // Use with method and redirect back to the calling page;
    }
}
