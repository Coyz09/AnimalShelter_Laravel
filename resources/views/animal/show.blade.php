@extends('layouts.base')
@section('body')
<div class="container">
  <h1>{{$animal->animal_Name}}</h1>
      <div class="table-responsive">
      <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>Animal ID</th>
              <th>Animal Type</th>
              <th>Animal Breed</th>
              <th>Animal Age</th>
              <th>Animal Rescue Place</th>
              <th>Animal Rescue Date</th>
              <th>Animal Image</th>
              <th>Injury Name</th>
              </tr>
          </thead>
          <tbody>
          <tr>
            <td>{{$animal->id}}</td>   
            <td>{{$animal->animal_Type}}</td>
            <td>{{$animal->animal_Breed}}</td>
            <td>{{$animal->animal_Age}}</td>
            <td>{{$animal->animal_Rescueplace}}</td>  
            <td>{{$animal->animal_Rescuedate}}</td> 
            <td><img src="{{asset($animal->animal_Image)}}" width="100px" height="100px"></td>
            <td>
                  @foreach($animal_injuries as $injury) 
                    @if($animal->id == $injury->animal_id)
                    {{$injury->injury_Name}}
                    <br>
                    @endif
                  @endforeach
                  @if($animal->id != $injury->animal_id)
                    {{'Healthy'}}
                 @endif
                  
                </td> 
          </tr>
          </tbody>
        </table>
        </div>
           <a href="{{url()->previous()}}" class="btn btn-primary a-btn-slide-text" role="button">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                <span><strong>Back</strong></span> 
          </a>  
</div>
@endsection