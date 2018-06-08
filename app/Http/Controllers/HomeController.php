<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
    *
    * Method to render index views test start
    */
    public function getIndex() {

      return view('home');
    }
}
