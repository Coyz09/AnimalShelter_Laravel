@extends('layouts.base')
@section('body')
<div class="container">
  <div class="form-group">
  <div class="row">
        <div class="col-md-2"  style="margin-top:80px"></div>
           <h1>Admin Profile</h1>
    </div>
 
    {{-- <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>Admin ID</th>
                <th>Admin Name</th>
                <th>Admin Email</th>
                <th>Admin Password</th>
                </tr>
            </thead>
            <tbody>
            <tr>
              <td>{{$admin->id}}</td>   
              <td>{{$admin->name}}</td>
              <td>{{$admin->email}}</td>
              <td>{{$admin->password}}</td>

               <td align="center"><a href="{{route('admin.edit',$admin->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:24px" ></a></i></td>

            </tr>
            </tbody>
          </table> --}}
           {{-- <a href="{{url()->previous()}}" class="btn btn-primary a-btn-slide-text" role="button">
                 <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                 <span><strong>Back</strong></span> 
        </a>  --}}
        {{-- </div> --}}
        <div class="row">
        <div class="col-md-4"></div>
          <div class="form-group col-md-4">
             {!!Form::label('Name:')!!}
             {!! Form::text('name',$admin->name,array('class' => 'form-control')) !!}
             @if($errors->has('name'))
              <a>{{ $errors->first('name') }}</a>
             @endif 
         </div>
    </div>


  <div class="row">
       <div class="col-md-4"></div>
          <div class="form-group col-md-4">
             {!!Form::label('Email:')!!}
             {!! Form::text('email',$admin->email,array('class' => 'form-control')) !!}
              @if($errors->has('email'))
              <a>{{ $errors->first('email') }}</a>
             @endif
        </div>
    </div>

    <div class="row" style="text-align:center;">
      <div class="col-md-4"></div>
        <div class="form-group col-md-4" style="margin-top:20px">
           
             <a href="{{route('admin.edit',$admin->id) }}}" class="btn btn-primary a-btn-slide-text" role="button" style="width:200px; text-align:center;">
                 <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                 <span><strong>EDIT</strong></span> 
        </a> 
      </div>
    </div> 
  </div>
@endsection