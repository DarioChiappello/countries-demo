<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::with(['languages', 'currencies'])->get();

        return response()->json($countries,200);
    }
}
