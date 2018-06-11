@extends('layouts.app')
@section('main-title') Intive FDV test @endsection
@section('main-content')
  <form class="form-signin" action="/" method="post">
    {{ csrf_field() }}
    <div class="text-center mb-4">
      <img class="mb-4" src="{{ asset('/img/rentabike.png') }}" alt="ACME RENTAL'S BIKES" width="100%" height="40%">
      <h1 class="h3 mb-3 font-weight-normal">ACME RENTAL'S BIKES</h1>
      <p>Please input the Quantity of bikes you may want to rent</p>
    </div>

    <div class="form-label-group">
      <input type="number" id="inputBike" name="inputBike" min="1" class="form-control" placeholder="Bike Qty" required autofocus>
      <label for="inputBike"># Bikes</label>
    </div>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Rent</button>
  </form>
@endsection
