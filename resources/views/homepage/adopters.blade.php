@extends('layouts.front')
@section('body')
<div class="container">
<h2>THE ADOPTERS</h2>
<div class="table-responsive">
<table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>Adopter First Name</th>
        <th>Adopter Last Name</th>
        <th>Adopter Address</th>
        <th>Adopter Contact</th>
        <th>Adopter Email</th>
        <th>Adopted Animal Name</th>
        </tr>
    </thead>

 <tbody>
      @foreach($adopters as $adopter)
      <tr>
          <td><a href="{{route('adopter.show',$adopter->id)}}">{{$adopter->adopter_Fname}}</a></td>
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
          
      @endforeach
    </tr>
    </tbody>
  </table>
</div>
</div>
@endsection
