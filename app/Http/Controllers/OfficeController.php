<?php

namespace App\Http\Controllers;

use App\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfficeController extends Controller
{
    public static function varOfficeList()
    {
        $officelist = Office::orderBy('name', 'asc')->get();
        return $officelist;
    }
}
