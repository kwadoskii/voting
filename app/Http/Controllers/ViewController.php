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
                $data->consti = Constituency::find($data->constituency_id)->name;
                return response()->json(['voter' => $data]);
                break;

            default:
                return response()->json(['message' => 'Data Not Found']);
                break;
        }
        // Use with method and redirect back to the calling page;
    }
}
