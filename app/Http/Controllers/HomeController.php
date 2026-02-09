<?php

namespace App\Http\Controllers;

use App\Models\Listing;

class HomeController extends Controller
{
    public function index()
    {
        $properties = Listing::latest()->take(5)->get();
        $cities = Listing::select('city')->distinct()->get();
        
        return view('home', compact('properties', 'cities'));
    }
}
