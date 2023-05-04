 @extends('layouts.base')
 @section('body')
<div class="container">
  <h2>Create new Injury</h2>
  {!! Form::open(['route' => 'injury.store']) !!}
  <input type="hidden" name="_token" value="{{ csrf_token() }}">


  <div class="row">
  <div class="col-md-4"></div>
    <div class="form-group col-md-4">
     {!!Form::label('Injury and Disease Type:')!!}
     {!! Form::text('injury_Name', ' ', ['class' => 'form-control']); !!}
       @if($errors->has('injury_Name'))
          <a>{{ $errors->first('injury_Name') }}</a>
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