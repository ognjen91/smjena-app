<?php

namespace App\Http\Controllers\Update;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ExceptionDay;


class ExceptionDays extends Controller
{
  public function __invoke(Request $request){
    try{
      $dateIsException = ExceptionDay::where('date', $request->date)->first();
      !$dateIsException? ExceptionDay::create(['date'=>$request->date]) : ExceptionDay::where('date', $request->date)->delete();
      // $theDate?  ExceptionDay::where('date', $theDate)->delete() : ExceptionDay::create(['date'=>$theDate]);


      return \Response::json([
          'message' => 'Status changed'
      ], 201); // Status code here

    } catch (\Exception $e){
      return \Response::json([
          'error' => $e->getMessage()
      ], 201); // Status code here
    }
  }}
