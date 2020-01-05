@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-12">
        <h3 class="text-center indigo--text darken-4">Shift Checker Admin</h3>
        <p class="display-5 indigo--text darken-4 text-center font-weight-bold">
          Uputstvo: Početne parametre je potrebno unjeti samo jednom.
          <br> Sistem će sam izračunati dalje smjene. Dodatno, možete dodati i slobodne dane.
        </p>
      </div>
      <div class="col-12">

        <admin-date-pickers
        :starting-date="{{$startingDate}}"
        :free-days="{{json_encode($freeDays)}}"
        :flipped-shift-days="{{json_encode($flippedShiftDays)}}"
        ></admin-date-pickers>
      </div>
    </div>
</div>
@endsection
