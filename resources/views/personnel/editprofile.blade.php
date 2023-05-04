@extends('layouts.base')
@section('body')
<div class="container">
  <h2>Update Rescuer</h2>
{{--   <form action="{{route('personnel.update',$personnel->id)}}" method="POST" >
  @csrf
  @method('POST')
 --}}
{!! Form::model($personnel,['method'=>'POST','route' => ['personnel.updateprofile',$personnel->id]]) !!}
 
 
    <div class="row">
        <div class="col-md-4"></div>
          <div class="form-group col-md-4">
             {!!Form::label('Personnel First Name:')!!}
             {!! Form::text('personnel_Fname',$personnel->personnel_Fname,array('class' => 'form-control')) !!}
             @if($errors->has('personnel_Fname'))
              <a>{{ $errors->first('personnel_Fname') }}</a>
             @endif 
         </div>
    </div>

    <div class="row">
            <div class="col-md-4"></div>
              <div class="form-group col-md-4">
                 {!!Form::label('Personnel Last Name:')!!}
                 {!! Form::text('personnel_Lname',$personnel->personnel_Lname,array('class' => 'form-control')) !!}
                 @if($errors->has('personnel_Lname'))
                  <a>{{ $errors->first('personnel_Lname') }}</a>
                 @endif 
             </div>
        </div>

  <div class="row">
        <div class="col-md-4"></div>
            {!!Form::label('Personnel Job:')!!}
          <div class="form-group col-md-4">
       
               @if($personnel->personnel_Job == 'Employee')
                 {!! Form::radio('personnel_Job', 'Employee',true, ['id' => 'Employee']) !!}
                 {!! Form::label('employee', 'Employee') !!}
              
                 {!! Form::radio('personnel_Job', 'Veterinarian',false, ['id' => 'Veterinarian']) !!}
                 {!! Form::label('veterinarian', 'Veterinarian') !!}

                 {!! Form::radio('personnel_Job', 'Volunteer',false, ['id' => 'Volunteer']) !!}
                 {!! Form::label('volunteer', 'Volunteer') !!}

               @elseif($personnel->personnel_Job == 'Veterinarian')
                 {!! Form::radio('personnel_Job', 'Employee',false, ['id' => 'Employee']) !!}
                 {!! Form::label('employee', 'Employee') !!}
              
                 {!! Form::radio('personnel_Job', 'Veterinarian',true, ['id' => 'Veterinarian']) !!}
                 {!! Form::label('veterinarian', 'Veterinarian') !!}

                 {!! Form::radio('personnel_Job', 'Volunteer',false, ['id' => 'Volunteer']) !!}
                 {!! Form::label('volunteer', 'Volunteer') !!}

               @elseif($personnel->personnel_Job == 'Volunteer')
                 {!! Form::radio('personnel_Job', 'Employee',false, ['id' => 'Employee']) !!}
                 {!! Form::label('employee', 'Employee') !!}
              
                 {!! Form::radio('personnel_Job', 'Veterinarian',false, ['id' => 'Veterinarian']) !!}
                 {!! Form::label('veterinarian', 'Veterinarian') !!}

                 {!! Form::radio('personnel_Job', 'Volunteer',true, ['id' => 'Volunteer']) !!}
                 {!! Form::label('volunteer', 'Volunteer') !!}
               @endif
           </div> 
            @if($errors->has('personnel_Job'))
              <a>{{ $errors->first('personnel_Job') }}</a>
             @endif 
      </div>

  <div class="row">
        <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            {!!Form::label('Personnel Contact:')!!}
            {!! Form::text('personnel_Contact',$personnel->personnel_Contact,array('class' => 'form-control')) !!}
            @if($errors->has('personnel_Contact'))
              <a>{{ $errors->first('personnel_Contact') }}</a>
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
</div>
{!! Form::close() !!}
@endsection