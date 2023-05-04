@extends('layouts.front')
@section('body')
<div class="container">
      <h1>Rescuer Profile</h1>
      <h2>{{$rescuer->rescuer_Fname}}</h2>
      <div class="table-responsive">
      <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>Rescuer ID</th>
              <th>Rescuer Last Name</th>
              <th>Rescuer Age</th>
              <th>Rescuer Address</th>
              <th>Rescuer Contact</th>
              <th>Rescuer Email</th>
              <th>Edit Profile</th>
              </tr>
          </thead>
          <tbody>
          <tr>
            <td>{{$rescuer->id}}</td>   
            <td>{{$rescuer->rescuer_Lname}}</td>
            <td>{{$rescuer->rescuer_Age}}</td>
            <td>{{$rescuer->rescuer_Address}}</td>
            <td>{{$rescuer->rescuer_Contact}}</td>
            <td>{{$rescuer->rescuer_Email}}</td>

          <td align="center"><a href="{{route('rescuer.editprofile',$rescuer->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:24px" ></a></i></td>

          </tr>
          </tbody>
        </table>
         
      </div>
 </div>

 <div class="container">
      <h2>Animals Rescued</h2>
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
              <th>Animal Image</th>         
              </tr>
          </thead>

          @foreach($rescuer->animals as $animal)
          <tbody>
          <tr>
            <td>{{$animal->animal_Name}}</td>
            <td>{{$animal->animal_Type}}</td>
            <td>{{$animal->animal_Breed}}</td>
            <td>{{$animal->animal_Age}}</td>
            <td>{{$animal->animal_Rescueplace}}</td>  
            <td>{{$animal->animal_Rescuedate}}</td> 
            <td><img src="{{asset($animal->animal_Image)}}" width="200px" height="200px"></td>
          </tr>
          </tbody>
        @endforeach
        </table>
         <a href="{{url()->previous()}}" class="btn btn-primary a-btn-slide-text" role="button">
                 <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                 <span><strong>Back</strong></span> 
        </a> 
      </div>
 </div>
@endsection