@extends('layouts.base')
@section('body')
<div class="container">
  <div class="row">
        <div class="col-md-2"  style="margin-top:80px"></div>
           <h1>Edit Admin Profile</h1>
    </div>
 
  {!! Form::model($admin,['method'=>'POST','route' => ['admin.update',$admin->id]]) !!}
 
    <div class="row">
        <div class="col-md-4"></div>
          <div class="form-group col-md-4">
             {!!Form::label('First Name:')!!}
             {!! Form::text('name',$admin->name,array('class' => 'form-control')) !!}
             @if($errors->has('name'))
              <a>{{ $errors->first('name') }}</a>
             @endif 
         </div>
    </div>

    <div class="row">
        <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            {!!Form::label('Last Name:')!!}
            {!! Form::text('lname','',array('class' => 'form-control')) !!}
            @if($errors->has('lname'))
              <a>{{ $errors->first('lname') }}</a>
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

    <div class="row">
        <div class="col-md-4"></div>
          <div class="form-group col-md-4">
             {!!Form::label('Password:')!!}
             {!! Form::text('password','',array('class' => 'form-control')) !!}
             @if($errors->has('password'))
              <a>{{ $errors->first('password') }}</a>
             @endif 
         </div>
    </div>

  <div class="row">
      <div class="col-md-4"></div>
        <div class="form-group col-md-4" style="margin-top:60px">
            <button type="submit" class="btn btn-primary">Update</button>
             <a href="{{url()->previous()}}" class="btn btn-default" role="button">Cancel</a>
      </div>
    </div> 

  </div>     
{!! Form::close() !!}
@endsection