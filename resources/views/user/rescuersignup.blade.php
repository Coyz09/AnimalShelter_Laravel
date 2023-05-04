@extends('layouts.masters')
@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            @include('layouts.flash-messages')
            <h1>Sign Up</h1>
            <form class="" action="{{ route('user.rescuersignup') }}" method="post">
                {{ csrf_field() }}

                 <div class="form-group">
                    <label for="fname">First Name: </label>
                    <input type="text" name="fname" id="fname" class="form-control">
                </div>

                <div class="form-group">
                    <label for="lname">Last Name: </label>
                    <input type="text" name="lname" id="lname" class="form-control">
                </div>

                 <div class="form-group">
                    <label for="age">Age: </label>
                    <input type="text" name="age" id="age" class="form-control">
                </div>

                <div class="form-group">
                    <label for="address">Address: </label>
                    <input type="text" name="address" id="address" class="form-control">
                </div>

                 <div class="form-group">
                    <label for="contact">Contact: </label>
                    <input type="text" name="contact" id="contact" class="form-control">
                </div>

                <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="text" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password: </label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                {!!Form::label('Choose animals to be rescued:')!!}
            <div class="row">

                 <div class="col-md-4"></div>
                 
                     <div class="form-group col-md-4">
                      @foreach ($animals as $id => $animal)
                        <div class="form-check form-check-inline">
                       {!!Form::checkbox('animal_id[]',$id, null, array('class'=>'form-check-input','id'=>'animal')) !!} 
                       {!!Form::label('animal', $animal,array('class'=>'form-check-label')) !!}
                         </div>
                        @endforeach
                      </div>  
                  </div>
 

                    <input type="submit" value="Sign Up" class="btn btn-primary">
                    <a href="{{route('homepage.animals')}}" class="btn btn-default" role="button">
                    <span><strong>Back</strong></span> 
                    </a>  
             </form>
        </div>
    </div>
@endsection 