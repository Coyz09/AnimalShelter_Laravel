 @extends('layouts.base')
 @section('body')
<div class="container">
  <h2>Create new Animal</h2>
{{--   <form method="post" action="{{route('animal.store')}} " > --}}
  {!! Form::open(['route' => 'animal.store', 'files' => true]) !!}
  <input type="hidden" name="_token" value="{{ csrf_token() }}">

  <div class="row">
  <div class="col-md-4"></div>
    <div class="form-group col-md-4">
      {!!Form::label('Animal Name:')!!}
      {!! Form::text('animal_Name', ' ', ['class' => 'form-control']); !!}
        @if($errors->has('animal_Name'))
        <a>{{ $errors->first('animal_Name') }}</a>
       @endif 
    </div>

  </div>

  <div class="row">
  <div class="col-md-4"></div>
    <div class="form-group col-md-4">
      {!!Form::label('Animal Type:')!!}
        <div class="radio">
           {!! Form::radio('animal_Type', 'DOG',false, ['id' => 'dog']) !!}
           {!! Form::label('dog', 'DOG') !!}
           {!! Form::radio('animal_Type', 'CAT',false,['id' => 'cat']) !!}
           {!! Form::label('cat', 'CAT') !!}   
        </div>  
        @if($errors->has('animal_Type'))
            <a>{{ $errors->first('animal_Type') }}</a>
         @endif    
    </div>
  </div>

  <div class="row">
  <div class="col-md-4"></div>
    <div class="form-group col-md-4">
     {!!Form::label('Animal Breed:')!!}
     {!! Form::text('animal_Breed', ' ', ['class' => 'form-control']); !!}
      @if($errors->has('animal_Breed'))
        <a>{{ $errors->first('animal_Breed') }}</a>
       @endif 
    </div>
   
  </div>

 <div class="row">
  <div class="col-md-4"></div>
    <div class="form-group col-md-4">
    {!!Form::label('Animal Age:')!!}
    {!! Form::text('animal_Age', ' ', ['class' => 'form-control']); !!}
      @if($errors->has('animal_Age'))
          <a>{{ $errors->first('animal_Age') }}</a>
         @endif 
  </div>
  </div>

  <div class="row">
    <div class="col-md-4"></div>
     <div class="form-group col-md-4">
      {!!Form::label('Animal Place of Rescue:')!!}
      {!! Form::text('animal_Rescueplace', ' ', ['class' => 'form-control']); !!}
      @if($errors->has('animal_Rescueplace'))
          <a>{{ $errors->first('animal_Rescueplace') }}</a>
         @endif
  </div>
  </div>

 <div class="row">
  <div class="col-md-4"></div>
    <div class="form-group col-md-4">
     {!!Form::label('Animal Date of Rescue:')!!}
     {!! Form::date('animal_Rescuedate', ' ', ['class' => 'form-control']); !!}
     @if($errors->has('animal_Rescuedate'))
          <a>{{ $errors->first('animal_Rescuedate') }}</a>
         @endif
  </div>
  </div>

  <div class="row">
      <div class="col-md-4"></div>
      <div class="form-group col-md-4">
        {!!Form::label('Select image to upload:')!!}
        {!! Form::file('animal_Image', ['class' => 'form-control']); !!}
          @if($errors->has('animal_Image'))
          <a>{{ $errors->first('animal_Image') }}</a>
         @endif

      </div>
  </div>

  <div class="row">
    <div class="col-md-4"></div>
         {!!Form::label('Injury and Disease Type:')!!}
         <div class="form-group col-md-4">
          @foreach ($injuries as $id => $injury)
            <div class="form-check form-check-inline">
           {!!Form::checkbox('injury_id[]',$id, null, array('class'=>'form-check-input','id'=>'injury')) !!}
           {!!Form::label('injury', $injury,array('class'=>'form-check-label')) !!}
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