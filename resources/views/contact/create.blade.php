@extends('layouts.front')
@section('body')
<style>
  
input[type=text], select, textarea {
  width: 100%; /* Full width */
  padding: 12px; /* Some padding */ 
  border: 1px solid #ccc; /* Gray border */
  border-radius: 4px; /* Rounded borders */
  box-sizing: border-box; /* Make sure that padding and width stays in place */
  margin-top: 6px; /* Add a top margin */
  margin-bottom: 16px; /* Bottom margin */
  resize: vertical /* Allow the user to vertically resize the textarea (not horizontally) */
}

/* Style the submit button with a specific background color etc */
input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

/* When moving the mouse over the submit button, add a darker green color */
input[type=submit]:hover {
  background-color: #45a049;
}

/* Add a background color and some padding around the form */
.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="container mt-5">
        <h2>Contact Us</h2>
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif

        <form action="/contact" method="post">

            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" placeholder="Your Full Name.."name="customer_Name" id="customer_Name">
                @if($errors->has('customer_Name'))
                    <a>{{ $errors->first('customer_Name') }}</a>
                   @endif 
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" placeholder="Your Email.." name="customer_Email" id="customer_Email">
                 @if($errors->has('customer_Email'))
                    <a>{{ $errors->first('customer_Email') }}</a>
                 @endif 
            </div>
     
            <div class="form-group">
                <label>Message</label>
                <textarea class="form-control" name="customer_Message" placeholder="Write something..." id="customer_Message" rows="5"></textarea>
                 @if($errors->has('customer_Messagee'))
                    <a>{{ $errors->first('customer_Message') }}</a>
                 @endif 
            </div>
            @csrf
            <button type="submit"  class="btn btn-dark btn-block">SEND</button>
        </form>
    </div>
</body> 

@endsection
