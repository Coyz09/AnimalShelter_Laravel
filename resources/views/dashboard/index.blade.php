{{-- @extends('layouts.master')

@section('content')
<h1>from dashboard</h1>
@endsection --}}

@extends('layouts.base')
@section('body')
<div class="container">


    <div class="row">
    <div  class="col-sm-6 col-md-6">
        <h2>Adopted Animal Demographics</h2>
    @if(empty($adoptedChart))
        <div id="app2"></div>
    @else
          <div id="app2">{!! $adoptedChart->container() !!}</div>
        {!! $adoptedChart->script() !!}
     @endif   
    </div>


    <div class="row">
    <div  class="col-sm-50 col-md-30">
        <h2>Rescued Animal Demographics</h2>
    @if(empty($rescuedChart))
        <div id="app2"></div>
    @else
          <div id="app2">{!! $rescuedChart->container() !!}</div>
        {!! $rescuedChart->script() !!}
     @endif   
    </div>
  </div>

 <div class="col-md-3"  style="margin-top:200px"></div>
  <div class="row">
    <div  class="col-sm-50 col-md-30">
        <h2>Animal Rescued Injuries Demographics</h2>
    @if(empty($injuriesChart))
        <div id="app2"></div>
    @else
          <div id="app2">{!! $injuriesChart->container() !!}</div>
        {!! $injuriesChart->script() !!}
     @endif   
    </div>
  </div>




    
 
@endsection