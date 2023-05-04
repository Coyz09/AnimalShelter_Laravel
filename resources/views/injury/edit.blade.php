@extends('layouts.base')
@section('body')
<div class="container">
  <h2>Update Injury</h2>
  <form action="{{route('injury.update',$injury->id)}}" method="POST" >
  @csrf
  @method('PUT')


   <div class="row">
        <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              {!!Form::label('Injury and Disease Name:')!!}
              {!! Form::text('injury_Name',$injury->injury_Name,array('class' => 'form-control')) !!}
               @if($errors->has('injury_Name'))
                <a>{{ $errors->first('injury_Name') }}</a>
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