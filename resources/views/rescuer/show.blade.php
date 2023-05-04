@extends('layouts.base')
@section('body')
<div class="container">
      <h1>{{$rescuer->rescuer_Fname}}</h1>
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
               <th>Rescued Animal Name</th>
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
            <td>
              @foreach($animal_rescuers as $animal) 
                 @if($rescuer->id == $animal->rescuer_id)
                  {{$animal->animal_Name}}
                   <br>
                   @endif
                  @endforeach    
            </td> 
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