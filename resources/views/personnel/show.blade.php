@extends('layouts.base')
@section('body')
<div class="container">
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