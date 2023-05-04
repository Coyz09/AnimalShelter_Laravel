<!-- resources/views/index.blade.php -->
@extends('layouts.base')
@section('body')
<div class="container">
<h2>Customer Emails</h2>
    @if ($message = Session::get('success'))
     <div class="alert alert-success alert-block">
     <button type="button" class="close" data-dismiss="alert">×</button> 
             <strong>{{ $message }}</strong>
     </div>
    @endif
<div class="table-responsive">
<table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>Customer ID</th>
        <th>Customer Name</th>
        <th>Customer Email</th>
        <th>Customer Message</th>

        <th>Delete</th>
        </tr>
    </thead>

  <tbody>
      @foreach($customers as $customer)
      <tr>
          <td>{{$customer->id}}</td>
          <td>{{$customer->customer_Name}}</td>
          <td>{{$customer->customer_Email}}</td>
          <td>{{$customer->customer_Message}}</td>
            
           <td align="center">
            <form action="{{route('customer.destroy',$customer->id) }}" method = "POST">
            @csrf
            @method('DELETE')
            <button><i class="fa fa-trash-o" style="font-size:24px; color:red"></i></button>
            </form>
          </td>
      
    </tr>
    @endforeach
    </tbody>
  </table>

</div>
</div>
@endsection

