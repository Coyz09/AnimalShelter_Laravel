@extends('layouts.front')
@section('body')
<div class="container">
  <h2>THE ANIMALS</h2>

      <div class="table-responsive">
<table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>Animal Name</th>
        <th>Animal Type</th>
        <th>Animal Breed</th>
        <th>Animal Age</th>
        <th>Animal Rescue Place</th>
        <th>Animal Rescue Date</th>
        <th>Adoption Status</th>
        <th>Animal Image</th>
        <th>Animal Status</th>
        
        </tr>
    </thead>

    <tbody>

         @foreach($animals as $animal) 
      <tr>
        <td><a href="{{route('homepage.animalshow',$animal->id)}}">{{$animal->animal_Name}}</a></td>
          <td>{{$animal->animal_Type}}</td>
          <td>{{$animal->animal_Breed}}</td>
          <td>{{$animal->animal_Age}}</td>
          <td>{{$animal->animal_Rescueplace}}</td>  
          <td>{{$animal->animal_Rescuedate}}</td> 
          <td>{{$animal->adoption_Status}}</td> 
          <td><img src="{{asset($animal->animal_Image)}}" width="200px" height="200px"></td>
           
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
        @endforeach

    </tr>
    </tbody>
  </table>
</div>
</div>
@endsection
