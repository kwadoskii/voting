<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AdminController extends Controller
{
    public function postAdminlogin(Request $request)
    {
        return redirect()->route('admindashboard');
    }

    public function getAdmindashboard()
    {
        return view('dashboard');
    }
}
