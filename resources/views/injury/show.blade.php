@extends('layouts.base')
@section('body')
<div class="container">
    <h1>{{$injury->injury_Name}}</h1>
    <div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>Injury ID</th>
            <th>Injury and Disease Name</th>

            </tr>
        </thead>
        <tbody>
        <tr>
          <td>{{$injury->id}}</td>   
          <td>{{$injury->injury_Name}}</td>
        </tr>
        </tbody>
      </table>
       <a href="{{url()->previous()}}" class="btn btn-primary a-btn-slide-text" role="button">
                  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                  <span><strong>Back</strong></span> 
            </a>  
    </div>
    </div>
@endsection