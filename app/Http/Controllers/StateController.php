<?php

namespace App\Http\Controllers;

use App\State;
use App\Lga;
use App\Admin;
use App\Office;
use App\Party;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StateController extends Controller
{
    public function postAddState(Request $request)
    {
        $this->validate($request, [
            'state' => 'required'
        ]);

        $name = $request->state;

        $state = New State();

        $state->name = $name;
        $state->save();

        return response()->json(['message' => 'Saved Successfully!'], 200);
    }

    public function postAddLga(Request $request)
    {
        $this->validate($request, [
            'lga' => 'required'
        ]);

        $name = $request->lga;
        $state = $request->state;

        $lga = New Lga();

        $lga->name = $name;
        $lga->state_id = $state;

        $lga->save();

        return response()->json(['message' => 'Saved Successfully'], 200);
    }

    public static function varStateList()
    {
        $statelist = State::orderBy('name', 'asc')->get();
        return $statelist;
    }

    public static function getid(Request $request)
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
        // Use with and redirect back to the calling page;
    }

    public static function varLgaList()
    {
        $lgalist = Lga::orderBy('state_id', 'asc')->get();
        return $lgalist;
    }
}
