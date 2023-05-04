@extends('layouts.base')
@section('body')
<div class="container">
  <h2>Update Animal</h2>
  {!! Form::model($animal,['method'=>'PATCH','route' => ['animal.update',$animal->id],'files' => true])!!}

     <div class="row">
              <div class="col-md-4"></div>
              <div class="form-group col-md-4">
               {!!Form::label('Animal Name:')!!}
               {!! Form::text('animal_Name',$animal->animal_Name,array('class' => 'form-control')) !!}
               @if($errors->has('animal_Name'))
                <a>{{ $errors->first('animal_Name') }}</a>
               @endif 
              </div>
     </div>

      <div class="row">
        <div class="col-md-4"></div>
          {!!Form::label('Animal Type:')!!}
          <div class="form-group col-md-4">
               @if($animal->animal_Type == 'DOG')
                 {!! Form::radio('animal_Type', 'DOG',true, ['id' => 'dog']) !!}
                 {!! Form::label('dog', 'DOG') !!}
              
                 {!! Form::radio('animal_Type', 'CAT',false,['id' => 'cat']) !!}
                 {!! Form::label('cat', 'CAT') !!}
               @elseif($animal->animal_Type == 'CAT')
                 {!! Form::radio('animal_Type', 'DOG',false, ['id' => 'dog']) !!}
                 {!! Form::label('dog', 'DOG') !!}

                 {!! Form::radio('animal_Type', 'CAT',true,['id' => 'cat']) !!}
                 {!! Form::label('cat', 'CAT') !!}
               @endif
           </div> 
           @if($errors->has('animal_Type'))
            <a>{{ $errors->first('animal_Type') }}</a>
         @endif  
      </div>

     <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
           {!!Form::label('Animal Breed:')!!}
           {!! Form::text('animal_Breed',$animal->animal_Breed,array('class' => 'form-control')) !!}
            @if($errors->has('animal_Breed'))
            <a>{{ $errors->first('animal_Breed') }}</a>
           @endif 
          </div>
      </div>

       <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
           {!!Form::label('Animal Age:')!!}
           {!! Form::text('animal_Age',$animal->animal_Age,array('class' => 'form-control')) !!}
           @if($errors->has('animal_Age'))
          <a>{{ $errors->first('animal_Age') }}</a>
         @endif 
          </div>
      </div>

      <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
           {!!Form::label('Animal Place of Rescue:')!!}
           {!! Form::text('animal_Rescueplace',$animal->animal_Rescueplace,array('class' => 'form-control')) !!}
           @if($errors->has('animal_Rescueplace'))
          <a>{{ $errors->first('animal_Rescueplace') }}</a>
         @endif
          </div>
      </div>

     <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
           {!!Form::label('Animal Date of Rescue:')!!}
           {!! Form::date('animal_Rescuedate',$animal->animal_Rescuedate,array('class' => 'form-control')) !!}
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
        @foreach ($injuries as $injury_id => $injury) 

          <div class="form-check form-check-inline">
           @if (in_array($injury_id, $animal_injury))

           {!! Form::checkbox('injury_id[]',$injury_id, true, array('class'=>'form-check-input','id'=>'injury')) !!} 
            {!!Form::label('injury', $injury,array('class'=>'form-check-label')) !!}

           @else
            {!! Form::checkbox('injury_id[]',$injury_id, null, array('class'=>'form-check-input','id'=>'injury')) !!} 
            {!!Form::label('injury', $injury,array('class'=>'form-check-label')) !!}
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
</div>
{!! Form::close() !!}
@endsection