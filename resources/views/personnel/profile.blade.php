@extends('layouts.front')
@section('body')
<div class="container">
    <h1>Personnel Profile</h1>
    <h1>{{$personnel->personnel_Fname}}</h1>
    <div class="table-responsive">
    <table class="table table-striped table-hover">

        <thead>
          <tr>
            <th>Personnel ID</th>
            <th>Personnel Last Name</th>
            <th>Personnel Job</th>
            <th>Personnel Contact</th>
            </tr>
        </thead>
        <tbody>
        <tr>
          <td>{{$personnel->id}}</td>   
          <td>{{$personnel->personnel_Lname}}</td>
          <td>{{$personnel->personnel_Job}}</td>
          <td>{{$personnel->personnel_Contact}}</td>
          <td align="center"><a href="{{route('personnel.editprofile',$personnel->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:24px" ></a></i></td>
        </tr>
        </tbody>
      </table>

    </div>
</div>

<div class="container">
    <h2>Animals Taken Care</h2>
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

          @foreach($personnel->animals as $animal)
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