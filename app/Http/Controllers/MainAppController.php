<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StartingDay;

class MainAppController extends Controller
{
    public function __invoke(){
      return view('welcome');
    }
}
