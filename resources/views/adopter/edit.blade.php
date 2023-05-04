@extends('layouts.base')
@section('body')
<div class="container">
  <h2>Update Adopter</h2>
  {!! Form::model($adopter,['method'=>'PATCH','route' => ['adopter.update',$adopter->id]]) !!}
 
    <div class="row">
        <div class="col-md-4"></div>
          <div class="form-group col-md-4">
             {!!Form::label('Adopter First Name:')!!}
             {!! Form::text('adopter_Fname',$adopter->adopter_Fname,array('class' => 'form-control')) !!}
             @if($errors->has('adopter_Fname'))
              <a>{{ $errors->first('adopter_Fname') }}</a>
             @endif 
         </div>
    </div>

    <div class="row">
        <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            {!!Form::label('Adopter Last Name:')!!}
            {!! Form::text('adopter_Lname',$adopter->adopter_Lname,array('class' => 'form-control')) !!}
            @if($errors->has('adopter_Lname'))
              <a>{{ $errors->first('adopter_Lname') }}</a>
             @endif
         </div>
    </div>

    <div class="row">
        <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            {!!Form::label('Adopter Address:')!!}
            {!! Form::text('adopter_Address',$adopter->adopter_Address,array('class' => 'form-control')) !!}
            @if($errors->has('adopter_Address'))
            <a>{{ $errors->first('adopter_Address') }}</a>
           @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            {!!Form::label('Adopter Contact:')!!}
            {!! Form::text('adopter_Contact',$adopter->adopter_Contact,array('class' => 'form-control')) !!}
            @if($errors->has('adopter_Contact'))
            <a>{{ $errors->first('adopter_Contact') }}</a>
           @endif
        </div>
    </div>

  <div class="row">
       <div class="col-md-4"></div>
          <div class="form-group col-md-4">
             {!!Form::label('Adopter Email:')!!}
             {!! Form::text('adopter_Email',$adopter->adopter_Email,array('class' => 'form-control')) !!}
              @if($errors->has('adopter_Email'))
              <a>{{ $errors->first('adopter_Email') }}</a>
             @endif
        </div>
    </div>

    <div class="row">
          <div class="col-md-4"></div>
          {!!Form::label('The Animals:')!!}
      <div class="form-group col-md-4">
        @foreach ($animals as $animal_id => $animal) 

        <div class="form-check form-check-inline">
           @if (in_array($animal_id, $adopter_animal))

           {!! Form::checkbox('animal_id[]',$animal_id, true, array('class'=>'form-check-input','id'=>'injury')) !!} 
            {!!Form::label('animal', $animal,array('class'=>'form-check-label')) !!}

           @else

            {!! Form::checkbox('animal_id[]',$animal_id, null, array('class'=>'form-check-input','id'=>'injury')) !!} 
            {!!Form::label('animal', $animal,array('class'=>'form-check-label')) !!}
            
           @endif
           </div>
          @endforeach 
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