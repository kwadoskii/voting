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

                try {
                    $party = Party::where('id', $id)->first();
                    $party->delete();
                } catch (\Throwable $th) {
                    return response()->json(['message' => 'ERR: '.'Cannot delete party with valid candidates'], 202);
                }

                break;

            case 'admin':
                if(Auth::guard('admin')->user() != Admin::find($id))
                {
                    $admin = Admin::where('id', $id)->first();
                    $admin->delete();
                }
                else{
                    return response()->json(['message' => 'Can not delete your own details.'], 202);
                }
                break;

            case 'office':

                try {
                    $office = Office::where('id', $id)->first();
                    $office->delete();
                } catch (\Throwable $th) {
                    return response()->json(['message' => 'ERR: '.'Cannot delete office with registered candidates'], 202);
                }

                break;

            case 'state':
                try {
                    $state = State::where('id', $id)->first();
                    $state->delete();
                } catch (\Throwable $th) {
                    return response()->json(['message' => 'ERR: '.'Cannot delete state with LGAs and Constituencies'], 202);
                }

                break;

            case 'lga':

                try {
                    $lga = Lga::where('id', $id)->first();
                    $lga->delete();
                } catch (\Throwable $th) {
                    return response()->json(['message' => 'ERR: '.'Cannot delete LGA with registered voters'], 202);
                }

                break;

            case 'candidate':
                $candidate = Candidate::where('id', $id)->first();
                $candidate->delete();
                break;

            case 'voter':
                try {
                    $voter = User::where('id', $id)->first();
                    $voter->delete();
                } catch (\Throwable $th) {
                    return response()->json(['message' => 'ERR: '.'Cannot delete Voter that is a valid candidate'], 202);
                }

                break;

            case 'constituency':
                // $lgas = Lga::where('constituency_id', $id)->get();

                // foreach($lgas as $lga)
                // {
                //     $lga->constituency_id = null;
                //     $lga->update();
                // }

                try {
                    $constituency = Constituency::where('id', $id)->first();
                    $constituency->delete();
                } catch (\Throwable $th) {
                    return response()->json(['message' => 'ERR: '.'Cannot delete Constituency with LGAs'], 202);
                }

                break;

            default:
                return response()->json(['message' => 'Error - Identifier Error'], 202);
                break;
        }

        return response()->json(['message' => 'Successfully Deleted!'], 201);
    }
}
