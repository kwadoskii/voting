<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function postAdminlogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        if(Auth::guard('admin')->attempt(['email' => $request['email'], 'password' => $request['password']])){
            return redirect()->route('admindashboard');
        }

        $message = 'Invalid Email or Password';
        return redirect()->back()->with(['message'=>$message]);

    }

    public function getAdmindashboard()
    {
        function getAdminDisplay()
        {
            return 'layouts.maindashboard';
        }



        return response()->view('dashboard', [
            'ab' => 'maindashboard'
        ], 200);
    }

    public function getAdminLogout()
    {
        Auth::guard('admin')->Logout();
        return redirect()->route('admin');
    }

    public function postGetDashDisplay(Request $request)
    {
        $ab = $request['display'];
        return response()->view('dashboard', [
            'ab' => $ab], 200);
    }
}