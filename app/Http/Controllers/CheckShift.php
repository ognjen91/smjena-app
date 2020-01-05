<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FreeDay;
use App\StartingDay;
use App\FlippedShiftDay;
use Carbon\Carbon;

class CheckShift extends Controller
{


  public function __invoke(Request $request){
    try{




      $dateToCheck = $request->date;
      $theStartingDay = StartingDay::firstOrCreate([]);
      $startingDate = $theStartingDay->date;
      $startingShift = $theStartingDay->shift;
      $shifts = ['prva', 'druga'];
      $indexOfStartingShift = array_search($startingShift, $shifts);
      $differentShift = $shifts[!$indexOfStartingShift];

      $durationOfShiftInDays = $theStartingDay->durationOfShiftInDays;
      $freeDaysBetween = FreeDay::whereBetween('date', [$startingDate, $dateToCheck])->get();
      $dateHasFlippedShift = FlippedShiftDay::where('date', $dateToCheck)->first();


      // check if the date is free day
      if($freeDaysBetween->where('date', $dateToCheck)->first()){
        return \Response::json([
            'value' => 'Slobodan dan'
        ], 201); // Status code here
      }

      /*
      CHECK IF SUNDAY (2/2... Home.vue = 1/2)
       */
       $dateToCheck = Carbon::parse($dateToCheck);
       $startingDate = Carbon::parse($startingDate);
      if($dateToCheck->dayOfWeek == 0){
        return \Response::json([
            'value' => 'Slobodan dan'
        ], 201); // Status code here
      }
      $firstDayInTheWeekOfTheDateToCheck = (clone $dateToCheck)->startOfWeek();
      $firstDayInTheWeekOfTheStartingDay = (clone $startingDate)->startOfWeek();

        //days in  a week where shift is the same as at the end of prev week
        $templateArrayOfFirstDaysInWeek = [];
        for($i=0; $i<floor($durationOfShiftInDays/2); $i++){
          $templateArrayOfFirstDaysInWeek[] = (clone $firstDayInTheWeekOfTheDateToCheck)->addDays($i)->format('Y-m-d');
        }

        //ako je razlika u sedmicama djeljiva sa 2, isti je sablon smjenskih dana u sedmici
        //if the difference in weeks is dividable with 2, it's the same template of shift days in a week
        if($firstDayInTheWeekOfTheStartingDay->diffInWeeks($firstDayInTheWeekOfTheDateToCheck)%2 == 0){
          //ako je isti sablon smjena, prvih n/2 dana daju suprotnu smjenu
          //if it is the same template of shifts, first n/2 days are in different shit
          $currentShift = in_array($dateToCheck->format('Y-m-d'), $templateArrayOfFirstDaysInWeek)? $differentShift : $startingShift;
      }else{
        //ako je razlicit sablon smjena, suprotno
        //& vice versa for different tempalte of shifts
          $currentShift = in_array($dateToCheck->format('Y-m-d'), $templateArrayOfFirstDaysInWeek)? $startingShift : $differentShift;
      }

      //finally, check if the date has flipped shift
      if($dateHasFlippedShift){
        $indexOfCurrentShift = array_search($currentShift, $shifts);
        $currentShift = $shifts[!$indexOfCurrentShift];
      }

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

  private static function checkIfDateIsSunday(\DateTime $date){
    $carbon = Carbon::instance($date);
    $carbon->setTimezone('Europe/berlin');
    // dd($carbon->setTimezone('Europe/berlin'));

    if($carbon->dayOfWeek == 0) return true;
    return false;
  }

}
