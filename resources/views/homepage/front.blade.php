@extends('layouts.front')
@section('body')
<div class="container">
<h2>ADOPTABLE ANIMALS</h2>   
<div class="table-responsive">
<table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>Animal Name</th>
        <th>Animal Type</th>
        <th>Animal Breed</th>
        <th>Animal Image</th>
        </tr>
    </thead>

      @foreach($animals as $animal)
      <tr>

          
          <td>{{$animal->animal_Name}}</td>
          <td>{{$animal->animal_Type}}</a></td>
          <td>{{$animal->animal_Breed}}</td>
          <td><img src="{{asset($animal->animal_Image)}}" width="400px" height="400px"></td>
      @endforeach  
          </td> 
          
    </tr>
    
  </table>
</div>
</div>
@endsection
