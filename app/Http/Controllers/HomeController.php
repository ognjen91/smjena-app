<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FreeDay;
use App\StartingDay;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $freeDays = FreeDay::select('date')->get();

        // dd($freeDays);
        // dd($startingDate);
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $freeDays = FreeDay::select('date')->get()->pluck('date');
        $startingDate = StartingDay::firstOrCreate([]);
        return view('home', compact('freeDays', 'startingDate'));
    }
}
