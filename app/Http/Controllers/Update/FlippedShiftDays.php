<?php

namespace App\Http\Controllers\Update;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\FlippedShiftDay;

class FlippedShiftDays extends Controller
{
  public function __invoke(Request $request){
    try{
      $dateIsException = FlippedShiftDay::where('date', $request->date)->first();
      !$dateIsException? FlippedShiftDay::create(['date'=>$request->date]) : FlippedShiftDay::where('date', $request->date)->delete();
      // $theDate?  FlippedShiftDay::where('date', $theDate)->delete() : FlippedShiftDay::create(['date'=>$theDate]);


      return \Response::json([
          'message' => 'Status changed'
      ], 201); // Status code here

    } catch (\Exception $e){
      return \Response::json([
          'error' => $e->getMessage()
      ], 201); // Status code here
    }
  }
}
