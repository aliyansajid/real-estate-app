<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $agents = User::where('role', 'agent')
            ->withCount('listings')
            ->orderBy('listings_count', 'desc')
            ->take(3)
            ->get();

        return view('about', compact('agents'));
    }
}
