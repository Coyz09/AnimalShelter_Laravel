@extends('layouts.front')
@section('body')
<div class="container">
  <h1>Adopter Profile</h1>
  <h1>{{$adopter->adopter_Fname}}</h1>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>Adopter ID</th>
                <th>Adopter Last Name</th>
                <th>Adopter Address</th>
                <th>Adopter Contact</th>
                <th>Adopter Email</th>
                </tr>
            </thead>
            <tbody>
            <tr>
              <td>{{$adopter->id}}</td>   
              <td>{{$adopter->adopter_Lname}}</td>
              <td>{{$adopter->adopter_Address}}</td>
              <td>{{$adopter->adopter_Contact}}</td>
              <td>{{$adopter->adopter_Email}}</td>

               <td align="center"><a href="{{route('adopter.editprofile',$adopter->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:24px" ></a></i></td>

            </tr>
            </tbody>
          </table>
        </div>
  </div>

  <div class="container">
      <h2>Animals Adopted</h2>
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

          @foreach($adopter->animals as $animal)
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