@extends('layouts.app')
@section('main-title') Intive FDV test @endsection
@section('main-content')
  <div class="container">
      <div class="text-center mb-4">
        <img class="mb-4" src="{{ asset('/img/rentabike.png') }}" alt="ACME RENTAL'S BIKES">
        <h1 class="h3 mb-3 font-weight-normal">ACME RENTAL'S BIKES</h1>
        <h2>Thanks to use ACME RENTAL'S BIKES service.</h2>
      </div>

        <div class="row">
          <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
              <span class="text-muted">Your bikes</span>
              <span class="badge badge-secondary badge-pill">{{ $bikes }}</span>
            </h4>
            <ul class="list-group mb-3">
              <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                  <h6 class="my-0">By Hour</h6>
                  <small class="text-muted">Rental by hour, charging $5 per hour</small>
                </div>
                <span class="text-muted">
                  @if(!$byHourFamily)
                    {{ $byHour }}
                  @else
                    <strike>{{ $byHour }} USD</strike> &nbsp; {{ $byHour - $byHourFamily  }} USD <small class="text-muted">with Family Discount</small>
                  @endif
                </span>
              </li>
              <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                  <h6 class="my-0">By Day</h6>
                  <small class="text-muted">Rental by day, charging $20 a day</small>
                </div>
                <span class="text-muted">
                  @if(!$byDayFamily)
                    {{ $byDay }}
                  @else
                    <strike>{{ $byDay }} USD</strike> &nbsp; {{ $byDay - $byDayFamily  }} USD <small class="text-muted">with Family Discount</small>
                  @endif
                </span>
              </li>
              <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                  <h6 class="my-0">By week</h6>
                  <small class="text-muted">Rental by week, changing $60 a week</small>
                </div>
                <span class="text-muted">
                  @if(!$byWeekFamily)
                    {{ $byWeekFamily }}
                  @else
                    <strike>{{ $byWeek }} USD</strike> &nbsp;  {{ $byWeekFamily - $byWeekFamily  }} USD <small class="text-muted">with Family Discount</small>
                  @endif
                </span>
                </span>
              </li>
            </ul>
          </div>
          <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Information: </h4>
            <form class="needs-validation" novalidate>
                <p class="lead">This may be the aproximate amount to pay after finish the rental's bike service.</p>
              <hr class="mb-4">
            </form>
          </div>
        </div>

      </div>
@endsection
