@extends('layouts.front')
@section('body')
<div class="container">
  <div class="form-group">
  <div class="row">
        <div class="col-md-2"  style="margin-top:80px"></div>
           <h1>User Profile</h1>
    </div>
        <div class="row">
        <div class="col-md-4"></div>
          <div class="form-group col-md-4">
             {!!Form::label('Name:')!!}
             {!! Form::text('name',$admin->name,array('class' => 'form-control')) !!}
             @if($errors->has('name'))
              <a>{{ $errors->first('name') }}</a>
             @endif 
         </div>
    </div>


  <div class="row">
       <div class="col-md-4"></div>
          <div class="form-group col-md-4">
             {!!Form::label('Email:')!!}
             {!! Form::text('email',$admin->email,array('class' => 'form-control')) !!}
              @if($errors->has('email'))
              <a>{{ $errors->first('email') }}</a>
             @endif
        </div>
    </div>

    <div class="row" style="text-align:center;">
      <div class="col-md-4"></div>
        <div class="form-group col-md-4" style="margin-top:20px">
           
             <a href="{{route('user.edit',$admin->id) }}}" class="btn btn-primary a-btn-slide-text" role="button" style="width:200px; text-align:center;">
                 <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                 <span><strong>EDIT</strong></span> 
        </a> 
      </div>
    </div> 
  </div>
@endsection