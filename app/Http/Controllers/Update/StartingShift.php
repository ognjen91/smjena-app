<?php

namespace App\Http\Controllers\Update;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\StartingDay;


class StartingShift extends Controller
{
  public function __invoke(Request $request){

    try{
      $startingDate = StartingDay::firstOrCreate([]);
      $startingDate->update([
        'shift' => $request->shift
      ]);

      return \Response::json([
          'message' => 'Shift changed'
      ], 201); // Status code here

    } catch (\Exception $e){
      return \Response::json([
          'error' => $e->getMessage()
      ], 201); // Status code here
    }

  }
}
