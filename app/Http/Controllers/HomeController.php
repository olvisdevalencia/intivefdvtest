<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
class HomeController extends Controller
{

    /**
    *
    * Method to render index views test start
    */
    public function getIndex() {

      return view('home');
    }

    /**
    *
    * Method to render view to get info of rental's bikes
    */
    public function rentBikes(request $request) {

      $bikes = $request->input('inputBike');

      $byHour       = $bikes * 5;
      $byDay        = $bikes * 20;
      $byWeek       = $bikes * 60;
      $byHourFamily = null;
      $byDayFamily  = null;
      $byWeekFamily = null;

      if ($bikes >= 3) {

        $byHourFamily = ($byHour * 30 ) / 100;
        $byDayFamily  = ($byDay  * 30 ) / 100;
        $byWeekFamily = ($byWeek * 30 ) / 100;
      }

      return view('success')->with([
                                    'bikes'   => $bikes ,
                                    'byHour'  => $byHour,
                                    'byDay'   => $byDay ,
                                    'byWeek'  => $byWeek,
                                    'byHourFamily'  => $byHourFamily,
                                    'byDayFamily'   => $byDayFamily ,
                                    'byWeekFamily'  => $byWeekFamily
                                  ]);

    }

    /**
    *
    * Method to calculate the total amount to pay to rental's bikes
    */
    public function rentBikesBydates(request $request) {

      $bikes      = $request->input('inputBike') ? $request->input('inputBike') : 3;
      $dateStart  = $request->input('dateStart') ? $request->input('dateStart') : new DateTime('2018-06-01 09:00:00');
      $dateEnd    = $request->input('dateEnd')   ? $request->input('dateEnd')   : new DateTime('2018-06-15 12:00:00');
      $datesDiffs = $this->time_elapsed_string($dateStart, $dateEnd);
      $fullDays   = $datesDiffs['fd'];

      $byHour       = $bikes * 5;
      $byDay        = $bikes * 20;
      $byWeek       = $bikes * 60;
      $byHourFamily = null;
      $byDayFamily  = null;
      $byWeekFamily = null;

      if ($bikes >= 3) {

        $byHourFamily = ($byHour * 30 ) / 100;
        $byDayFamily  = ($byDay  * 30 ) / 100;
        $byWeekFamily = ($byWeek * 30 ) / 100;

        $byHour = $byHour - $byHourFamily;
        $byDay  = $byDay  - $byDayFamily;
        $byWeek = $byWeek - $byWeekFamily;
      }

      switch ($fullDays) {

        case ($fullDays >1 && $fullDays < 7):
          // By Day
          $days   = $datesDiffs['d']  * $byDay;
          $hours  = $datesDiffs['h'] * $byHour;

          $totalPayment = $days + $hours;
        break;


        case ($fullDays > 7):
          // By Week
          $weeks  = $datesDiffs['w'] * $byWeek;
          $days   = $datesDiffs['d'] * $byDay;
          $hours  = $datesDiffs['h'] * $byHour;

          $totalPayment = $weeks + $days + $hours;
        break;

        default:
        // By Hour
        $totalPayment = $datesDiffs['h'] * $byHour;
        break;
      }

      return $totalPayment;

    }

    /**
    *
    * Method to get the custom date diff
    */
    public function time_elapsed_string($dateStart, $dateEnd) {

        $diff  = $dateStart->diff($dateEnd);

        $diff->w = floor($diff->d / 7);
        $diff->fd = $diff->d;
        $diff->d -= $diff->w * 7;

        $values = [
            'w'  => (int)$diff->w,
            'd'  => (int)$diff->d,
            'h'  => (int)$diff->h,
            'fd' => (int)$diff->fd,
        ];

        return collect($values);
  }

}
