@extends('layouts.base')
@section('body')
<div class="container">
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
                <th>Adopted Animal Name</th>
                </tr>
            </thead>
            <tbody>
            <tr>
              <td>{{$adopter->id}}</td>   
              <td>{{$adopter->adopter_Lname}}</td>
              <td>{{$adopter->adopter_Address}}</td>
              <td>{{$adopter->adopter_Contact}}</td>
              <td>{{$adopter->adopter_Email}}</td>
               <td>
                    @foreach($adopter_animals as $animal) 
                      @if($adopter->id == $animal->adopter_id)
                      {{$animal->animal_Name}}
                      <br>
                      @endif
                    @endforeach    
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