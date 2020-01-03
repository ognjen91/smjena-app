<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FreeDay;
use App\StartingDay;
use Carbon\Carbon;

class CheckShift2 extends Controller
{


  public function __invoke(Request $request){
    try{

      $dateToCheck = $request->date;
      $startingDay = StartingDay::firstOrCreate([])->date;
      $durationOfShiftInDays = StartingDay::firstOrCreate([])->durationOfShiftInDays;
      $freeDaysBetween = FreeDay::whereBetween('date', [$startingDay, $dateToCheck])->get();
      // dd($freeDaysBetween->pluck('date')->toArray());
      //
      // check if the date is free day
      if($freeDaysBetween->where('date', $dateToCheck)->first()){
        return \Response::json([
            'value' => 'Slobodan dan'
        ], 201); // Status code here
      }

      $numberOfFreeDaysInThePeriod = $freeDaysBetween->count();
      $numberOfSundaysInThePeriod = self::calculateNumberOfSundaysBeweenTwoDates($startingDay, $dateToCheck);
      // dd($numberOfSundaysInThePeriod);

      $startingDay = Carbon::parse($startingDay);
      $dateToCheck = Carbon::parse($dateToCheck);
      // $now = Carbon::now();


      $totalDaysInThePeriod = $dateToCheck->diffInDays($startingDay)+1;
      // dd($totalDaysInThePeriod);

      $totalWorkinDaysInThePeriod = $totalDaysInThePeriod - $numberOfSundaysInThePeriod - $numberOfFreeDaysInThePeriod;
      // dd($totalDaysInThePeriod, $totalWorkinDaysInThePeriod, $numberOfSundaysInThePeriod, $numberOfFreeDaysInThePeriod);
      $x = $totalWorkinDaysInThePeriod%6;
      // dd($x);
      // dd($totalWorkinDaysInThePeriod, $x);
      $startingShift = StartingDay::firstOrCreate([])->shift;
      $differentShift = $startingShift == 'prva'? 'druga' : 'prva';
      // dd($differentShift);
      // dd($x, in_array($x, [1,2,3]));

      $currentShift = in_array($x, [1,2,3])? $startingShift : $differentShift;
      // $currentShift = in_array($x, $modulusOfTheSameShift)? $startingShift : $differentShift;
      // dd($x, $currentShift);
      return \Response::json([
          'value' => $currentShift
      ], 201); // Status code here



      return \Response::json([
          'message' => 'Success'
      ], 201); // Status code here

    } catch (\Exception $e){
      return \Response::json([
          'error' => $e->getMessage()
      ], 201); // Status code here
    }
  }

  private static function calculateNumberOfSundaysBeweenTwoDates(String $start, String $end){
      $start = new \DateTime($start);
      $end = new \DateTime($end);
      $days = $start->diff($end, true)->days;

      $sundays = intval($days / 7) + ($start->format('N') + $days % 7 >= 7);

      return $sundays;
  }

}
