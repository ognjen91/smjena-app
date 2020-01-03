<?php

namespace App\Http\Controllers\Update;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\StartingDay;

class StartingDate extends Controller
{
    public function __invoke(Request $request){
      try{
        $startingDate = StartingDay::firstOrCreate([]);
        if(!$startingDate) throw new \Exception('Starting date not found');

        $startingDate->update([
          'date' => $request->date
        ]);
        return \Response::json([
            'message' => 'Success'
        ], 201); // Status code here

      } catch (\Exception $e){
        return \Response::json([
            'error' => $e->getMessage()
        ], 201); // Status code here
      }
    }
}
