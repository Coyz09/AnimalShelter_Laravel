 @extends('layouts.base')
 @section('body')
<div class="container">
  <h2>Create new Rescuer</h2>
  {!! Form::open(['route' => 'rescuer.store']) !!}
  <input type="hidden" name="_token" value="{{ csrf_token() }}">

  <div class="row">
  <div class="col-md-4"></div> 
    <div class="form-group col-md-4">
      {!!Form::label('Rescuer First Name:')!!}
      {!! Form::text('rescuer_Fname', ' ', ['class' => 'form-control']); !!}
      @if($errors->has('rescuer_Fname'))
        <a>{{ $errors->first('rescuer_Fname') }}</a>
       @endif 
    </div>
  </div>

  <div class="row">
    <div class="col-md-4"></div> 
      <div class="form-group col-md-4">
        {!!Form::label('Rescuer Last Name:')!!}
        {!! Form::text('rescuer_Lname', ' ', ['class' => 'form-control']); !!}
          @if($errors->has('rescuer_Lname'))
            <a>{{ $errors->first('rescuer_Lname') }}</a>
           @endif 
      </div>
  </div>

  <div class="row">
    <div class="col-md-4"></div> 
      <div class="form-group col-md-4">
        {!!Form::label('Rescuer Age:')!!}
        {!! Form::text('rescuer_Age', ' ', ['class' => 'form-control']); !!}
        @if($errors->has('rescuer_Age'))
          <a>{{ $errors->first('rescuer_Age') }}</a>
         @endif 
      </div>
  </div>

  <div class="row">
    <div class="col-md-4"></div> 
      <div class="form-group col-md-4">
        {!!Form::label('Rescuer Address:')!!}
        {!! Form::text('rescuer_Address', ' ', ['class' => 'form-control']); !!}
        @if($errors->has('rescuer_Address'))
        <a>{{ $errors->first('rescuer_Address') }}</a>
       @endif 
      </div>
  </div>

  <div class="row">
    <div class="col-md-4"></div> 
      <div class="form-group col-md-4">
        {!!Form::label('Rescuer Contact:')!!}
        {!! Form::text('rescuer_Contact', ' ', ['class' => 'form-control']); !!}
        @if($errors->has('rescuer_Contact'))
        <a>{{ $errors->first('rescuer_Contact') }}</a>
       @endif 
      </div>
  </div>


   <div class="row">
      <div class="col-md-4"></div> 
        <div class="form-group col-md-4">
          {!!Form::label('Rescuer Email:')!!}
          {!! Form::email('rescuer_Email', '',['class' => 'form-control']) !!}
          @if($errors->has('rescuer_Email'))
            <a>{{ $errors->first('rescuer_Email') }}</a>
           @endif 
        </div>
   </div>

  <div class="row">
     <div class="col-md-4"></div>
     {!!Form::label('The Animals:')!!}
         <div class="form-group col-md-4">
          @foreach ($animals as $id => $animal)
            <div class="form-check form-check-inline">
           {!!Form::checkbox('animal_id[]',$id, null, array('class'=>'form-check-input','id'=>'animal')) !!} 
           {!!Form::label('animal', $animal,array('class'=>'form-check-label')) !!}
             </div>
            @endforeach
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