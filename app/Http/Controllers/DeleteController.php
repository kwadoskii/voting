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

class DeleteController extends Controller
{
    public function deletedata(Request $request)
    {
        $id = $request['id'];
        $identifier = $request['identifier'];

        switch ($identifier) {
            case 'party':
                $party = Party::where('id', $id)->first();
                $party->delete();
                break;

            case 'admin':
                $admin = Admin::where('id', $id)->first();
                $admin->delete();
                break;

            case 'office':
                $office = Office::where('id', $id)->first();
                $office->delete();
                break;

            case 'state':
                $state = State::where('id', $id)->first();
                $state->delete();
                break;

            case 'lga':
                $lga = Lga::where('id', $id)->first();
                $lga->delete();
                break;

            case 'constituency':
                $lgas = Lga::where('constituency_id', $id)->get();
                
                foreach($lgas as $lga)
                {
                    $lga->constituency_id = null;
                    $lga->update();
                }

                $constituency = Constituency::where('id', $id)->first();
                $constituency->delete();
                break;

            default:
                return response()->json(['message' => 'An error Occured!'], 201);
                break;
        }

        return response()->json(['message' => 'Successfully Deleted!'], 200);
    }
}
