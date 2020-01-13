<?php

namespace App\Http\Controllers;

use App\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BallotController extends Controller
{
    public function getBallot()
    {
        return view('ballot')->with(['offices' => Office::all()]);
    }
}
