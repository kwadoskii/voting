<?php

namespace App\Http\Controllers;

use App\Office;
use App\Lga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BallotController extends Controller
{
    public function getBallot()
    {
        return view('ballot')->with(['offices' => Office::all(), 'Lga' => Lga::all()]);
    }
}
