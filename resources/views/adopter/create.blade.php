 @extends('layouts.base')
 @section('body')
<div class="container">
  <h2>Create new Adopter</h2>
  {!! Form::open(['route' => 'adopter.store']) !!}
  <input type="hidden" name="_token" value="{{ csrf_token() }}">

  <div class="row">
  <div class="col-md-4"></div> 
    <div class="form-group col-md-4">
      {!!Form::label('Adopter First Name:')!!}
      {!! Form::text('adopter_Fname', ' ', ['class' => 'form-control']); !!}
      @if($errors->has('adopter_Fname'))
        <a>{{ $errors->first('adopter_Fname') }}</a>
       @endif 
    </div>
  </div>

  <div class="row">
    <div class="col-md-4"></div> 
      <div class="form-group col-md-4">
        {!!Form::label('Adopter Last Name:')!!}
        {!! Form::text('adopter_Lname', ' ', ['class' => 'form-control']); !!}
        @if($errors->has('adopter_Lname'))
        <a>{{ $errors->first('adopter_Lname') }}</a>
       @endif
      </div>
    </div>

  <div class="row">
  <div class="col-md-4"></div> 
    <div class="form-group col-md-4">
        {!!Form::label('Adopter Address:')!!}
        {!! Form::text('adopter_Address', ' ', ['class' => 'form-control']); !!}
        @if($errors->has('adopter_Address'))
        <a>{{ $errors->first('adopter_Address') }}</a>
       @endif
    </div>
  </div>

  <div class="row">
    <div class="col-md-4"></div> 
      <div class="form-group col-md-4">
        {!!Form::label('Adopter Contact:')!!}
        {!! Form::text('adopter_Contact', ' ', ['class' => 'form-control']); !!}
        @if($errors->has('adopter_Contact'))
        <a>{{ $errors->first('adopter_Contact') }}</a>
       @endif
      </div>
    </div>

   <div class="row">
    <div class="col-md-4"></div> 
      <div class="form-group col-md-4">
        {!!Form::label('Adopter Email:')!!}
        {!! Form::email('adopter_Email', '',['class' => 'form-control']) !!}
        @if($errors->has('adopter_Email'))
        <a>{{ $errors->first('adopter_Email') }}</a>
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