@extends('layouts.front')
@section('body')
<div class="container">
   {{--   @include('layouts.flash-messages') --}}
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
           
</div>


<div class="container">
  <h1> Comments: </h1>
  <div class="row">
    <div id="comment-form" class="col-md-8 col-md-offset-2">   
       <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
            <tr>
              <th>Name</th>
        {{--       <th>Email</th> --}}
              <th>Comment</th>
              </tr>
          </thead>
      <tbody>
        @foreach($comment as $comments)
        @if($animal->id == $comments->animal_id)
        <tr>
          <td>{{ $comments->name }}</td>
{{--           <td>{{ $comments->email }}</td> --}}
          <td>{{ $comments->comment }}<td>
        </tr>
        @endif
        @endforeach
          </tbody>
          </table>
      </div>
<a href="{{route('homepage.animals')}}" class="btn btn-primary a-btn-slide-text" role="button">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                <span><strong>Back</strong></span> 
          </a>  
    </div>
  </div>
 
  <div class="row">
    
    <div id="comment-form" class="col-md-8 col-md-offset-2" style="margin-top:5px">
<h1> Add Comment: </h1>
       {!! Form::open(['route' => 'animal.comment', 'method' => 'POST']) !!}

        <div class="row">
          <div class="col-md-2">
              {{ Form::label('animal_id', "Animal ID:") }}
              {!! Form::text('animal_id',$animal->id,array('class' => 'form-control','readonly' => 'true')) !!}

          </div>

          <div class="col-md-6">
              {{ Form::label('name', "Name:") }}
              {{ Form::text('name', null, ['class'=> 'form-control']) }}
            

          
              {{ Form::label('email', "Email:") }}
              {{ Form::text('email', null, ['class'=> 'form-control']) }}
         

          
              {{ Form::label('comment', "Comment:") }}
                {{ Form::textarea('comment',null, ['class'=> 'form-control']) }}
              
              @include('layouts.flash-messages')
              {{ Form::submit('Add Comment',['class'=> 'btn btn-success btn-block','style' => 'margin-top:15px;']) }}
          </div>
</div>

        </div>

              {{ Form::close() }}  
        </div>
  </div>

@endsection