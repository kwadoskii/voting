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

class CandidateController extends Controller
{
    public static function getCandidateList()
    {
        $candidate = Candidate::all();
        return $candidate;
    }

    public static function getOfficeList()
    {
        $office = Office::all();
        return $office;
    }

    public static function getVoterList()
    {
        $voter = User::orderBy('first_name', 'asc')->get();
        return $voter;
    }

    public static function getStateList()
    {
        $state = State::orderBy('name', 'asc')->get();
        return $state;
    }
}
