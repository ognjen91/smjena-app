<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FreeDay;
use App\StartingDay;
use Carbon\Carbon;

class CheckShift extends Controller
{


  public function __invoke(Request $request){
    try{

      /*
      CHECK IF SUNDAY
       */
      if(self::checkIfDateIsSunday(new \DateTime())){
        return \Response::json([
            'value' => 'Slobodan dan'
        ], 201); // Status code here
      }

      $dateToCheck = $request->date;
      $theStartingDay = StartingDay::firstOrCreate([]);
      $startingDay = $theStartingDay->date;
      $durationOfShiftInDays = $theStartingDay->durationOfShiftInDays;
      $freeDaysBetween = FreeDay::whereBetween('date', [$startingDay, $dateToCheck])->get();
      // dd($freeDaysBetween->pluck('date')->toArray());

      // check if the date is free day
      if($freeDaysBetween->where('date', $dateToCheck)->first()){
        return \Response::json([
            'value' => 'Slobodan dan'
        ], 201); // Status code here
      }

      $dateToCheck = Carbon::parse($dateToCheck);

      $numberOfFreeDaysInThePeriod = $freeDaysBetween->count();
      $numberOfSundaysInThePeriod = self::calculateNumberOfSundaysBeweenTwoDates($startingDay, $dateToCheck);

      $startingDay = Carbon::parse($startingDay);


      $totalDaysInThePeriod = $dateToCheck->diffInDays($startingDay)+1;

      $totalWorkinDaysInThePeriod = $totalDaysInThePeriod - $numberOfSundaysInThePeriod - $numberOfFreeDaysInThePeriod;

      $x = $totalWorkinDaysInThePeriod%($durationOfShiftInDays*2);

      $startingShift = $theStartingDay->shift;
      $differentShift = $startingShift == 'prva'? 'druga' : 'prva';

      $modulusOfTheSameShift = [];
      for ($i=1; $i <=$durationOfShiftInDays; $i++) {
        $modulusOfTheSameShift[] = $i;
      }
      // dd($modulusOfTheSameShift);
      // $currentShift = in_array($x, [1,2,3])? $startingShift : $differentShift;
      $currentShift = in_array($x, $modulusOfTheSameShift)? $startingShift : $differentShift;
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
