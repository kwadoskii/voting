<?php

namespace App\Http\Controllers;

use App\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfficeController extends Controller
{
    public function postAddOffice(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $name = $request['name'];
        $consti = $request['consti'];
        $state = $request['state'];

        $office = New Office();

        $office->name = $name;
        $office->is_constituency = $consti;
        $office->is_state = $state;
        $office->save();

        return response()->json(['message' => 'Created Successfully!']);
    }

    public static function varOfficeList()
    {
        $officelist = Office::orderBy('name', 'asc')->get();
        return $officelist;
    }
}
