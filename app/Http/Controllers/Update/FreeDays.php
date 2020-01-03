<?php

namespace App\Http\Controllers\Update;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\FreeDay;


class FreeDays extends Controller
{
  public function __invoke(Request $request){
    try{
      $dateIsFree = FreeDay::where('date', $request->date)->first();
      !$dateIsFree? FreeDay::create(['date'=>$request->date]) : FreeDay::where('date', $request->date)->delete();
      // $theDate?  FreeDay::where('date', $theDate)->delete() : FreeDay::create(['date'=>$theDate]);


      return \Response::json([
          'message' => 'Status changed'
      ], 201); // Status code here

    } catch (\Exception $e){
      return \Response::json([
          'error' => $e->getMessage()
      ], 201); // Status code here
    }
  }}
