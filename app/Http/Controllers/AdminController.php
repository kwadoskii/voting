<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Candidate;
use App\Party;
use App\State;
use App\User;
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
        $candidates = Candidate::count();
        $voters = User::count();
        $parties = Party::count();
        $states = State::count();

        return response()->view('dashboard', [
            'ab' => 'layouts.maindashboard',
            'candidates' => $candidates,
            'voters' => $voters,
            'parties' => $parties,
            'states' => $states
        ], 200);
    }

    public function getAdminLogout()
    {
        Auth::guard('admin')->Logout();
        return redirect()->route('admin');
    }

    public function postGetDashDisplay(Request $request)
    {
        $ab = $request->display;
        $ab = "layouts.$ab";

        return response()->view("$ab", [
            'ab' => "$ab"], 200);
    }

    public function postAddAdmin(Request $request)
    {
        $firstname = $request->firstname;
        $middlename = $request->middlename;
        $lastname = $request->lastname;
        $gender = $request->gender;
        $dob = $request->dob;
        $phone = $request->phone;
        $email = $request->email;
        $password = bcrypt($request->password);

        $admin = New Admin();

        $admin->first_name = $firstname;
        $admin->mid_name = $middlename;
        $admin->last_name = $lastname;
        $admin->gender = $gender;
        $admin->dob = $dob;
        $admin->phone = $phone;
        $admin->email = $email;
        $admin->password = $password;

        $admin->save();

        return response()->json(['message' => 'Admin Created Successfully!', 'id' => $admin->id], 200);

    }

    public static function varAdminList()
    {
        $adminlist = Admin::orderBy('created_at', 'desc')->get();
        return $adminlist;
    }
}
