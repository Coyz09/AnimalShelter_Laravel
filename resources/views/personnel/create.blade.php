 @extends('layouts.base')
 @section('body')
<div class="container">
  <h2>Create new Personnel</h2>
    {!! Form::open(['route' => 'personnel.store']) !!}
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="row">
      <div class="col-md-4"></div> 
        <div class="form-group col-md-4">
          {!!Form::label('Personnel First Name:')!!}
          {!! Form::text('personnel_Fname', ' ', ['class' => 'form-control']); !!}
          @if($errors->has('personnel_Fname'))
            <a>{{ $errors->first('personnel_Fname') }}</a>
           @endif 
        </div>
      </div>

     <div class="row">
      <div class="col-md-4"></div> 
        <div class="form-group col-md-4">
          {!!Form::label('Personnel Last Name:')!!}
          {!! Form::text('personnel_Lname', ' ', ['class' => 'form-control']); !!}
           @if($errors->has('personnel_Lname'))
            <a>{{ $errors->first('personnel_Lname') }}</a>
           @endif 
        </div>
      </div>

    <div class="row">
      <div class="col-md-4"></div>
        <div class="form-group col-md-4">
          {!!Form::label('Animal Type:')!!}
            <div class="radio">
               {!! Form::radio('personnel_Job', 'Employee',false, ['id' => 'employee']) !!}
               {!! Form::label('employee', 'Employee') !!}

               {!! Form::radio('personnel_Job', 'Veterinarian',false,['id' => 'veterinarian']) !!}
               {!! Form::label('veterinarian', 'Veterinarian') !!}   

               {!! Form::radio('personnel_Job', 'Volunteer',false,['id' => 'volunteer']) !!}
               {!! Form::label('volunteer', 'Volunteer') !!}   

            </div>
             @if($errors->has('personnel_Job'))
              <a>{{ $errors->first('personnel_Job') }}</a>
             @endif 
        </div>
      </div>

    <div class="row">
      <div class="col-md-4"></div> 
        <div class="form-group col-md-4">
          {!!Form::label('Personnel Contact:')!!}
          {!! Form::text('personnel_Contact', ' ', ['class' => 'form-control']); !!}
           @if($errors->has('personnel_Contact'))
              <a>{{ $errors->first('personnel_Contact') }}</a>
            @endif 
        </div>
      </div>


    <div class="row">
        <div class="col-md-4"></div>
          <div class="form-group col-md-4" style="margin-top:60px">
              <button type="submit" class="btn btn-primary">Save</button>
               <a href="{{url()->previous()}}" class="btn btn-default" role="button">Cancel</a>
        </div>
   </div>   

</div>
{!! Form::close() !!}
@endsection