<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SetLocale extends Controller
{
  public function __invoke(Request $request){
    try{

      if(!array_key_exists($request->locale, app('locales'))) throw new \Exception('Locale does not exist');

      \App::setLocale($request->locale);
      session(['locale' => $request->locale]);


      return \Response::json([
          'message' => 'Locale changed'
      ], 201); // Status code here

    } catch (\Exception $e){
      return \Response::json([
          'error' => $e->getMessage()
      ], 201); // Status code here
    }
  }
}
