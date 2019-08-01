<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Candidate;
use App\Party;
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
        // global $idd;
        // $GLOBALS['idd']  = $id;
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

            default:
                return response()->json(['message' => 'Data Not Found']);
                break;
        }
        // Use with method and redirect back to the calling page;
    }
}
