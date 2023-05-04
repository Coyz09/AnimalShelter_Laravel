@extends('layouts.front')
@section('body')
<div class="container">
  <h2>Update Rescuer</h2>
    {!! Form::model($rescuer,['method'=>'POST','route' => ['rescuer.updateprofile',$rescuer->id]]) !!}

   <div class="row">
        <div class="col-md-4"></div>
          <div class="form-group col-md-4">
             {!!Form::label('Rescuer First Name:')!!}
             {!! Form::text('rescuer_Fname',$rescuer->rescuer_Fname,array('class' => 'form-control')) !!}
             @if($errors->has('rescuer_Fname'))
              <a>{{ $errors->first('rescuer_Fname') }}</a>
             @endif 
         </div>
    </div>

   <div class="row">
        <div class="col-md-4"></div>
          <div class="form-group col-md-4">
             {!!Form::label('Rescuer Last Name:')!!}
             {!! Form::text('rescuer_Lname',$rescuer->rescuer_Lname,array('class' => 'form-control')) !!}
              @if($errors->has('rescuer_Lname'))
                <a>{{ $errors->first('rescuer_Lname') }}</a>
               @endif 
         </div>
    </div>

   <div class="row">
        <div class="col-md-4"></div>
          <div class="form-group col-md-4">
             {!!Form::label('Rescuer Age:')!!}
             {!! Form::text('rescuer_Age',$rescuer->rescuer_Age,array('class' => 'form-control')) !!}
             @if($errors->has('rescuer_Age'))
              <a>{{ $errors->first('rescuer_Age') }}</a>
             @endif 
         </div>
    </div>

    <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4">
               {!!Form::label('Rescuer Address:')!!}
               {!! Form::text('rescuer_Address',$rescuer->rescuer_Address,array('class' => 'form-control')) !!}
               @if($errors->has('rescuer_Address'))
                <a>{{ $errors->first('rescuer_Address') }}</a>
               @endif 
           </div>
      </div>

      <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4">
               {!!Form::label('Rescuer Contact:')!!}
               {!! Form::text('rescuer_Contact',$rescuer->rescuer_Contact,array('class' => 'form-control')) !!}
               @if($errors->has('rescuer_Contact'))
                <a>{{ $errors->first('rescuer_Contact') }}</a>
               @endif 
           </div>
      </div>

     <div class="row">
         <div class="col-md-4"></div>
            <div class="form-group col-md-4">
               {!!Form::label('Rescuer Email:')!!}
               {!! Form::text('rescuer_Email',$rescuer->rescuer_Email,array('class' => 'form-control')) !!}
               @if($errors->has('rescuer_Email'))
                <a>{{ $errors->first('rescuer_Email') }}</a>
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