<!-- resources/views/index.blade.php -->
@extends('layouts.base')
@section('body')
<div class="container">
<h2>Rescuers</h2>
    @if ($message = Session::get('success'))
     <div class="alert alert-success alert-block">
     <button type="button" class="close" data-dismiss="alert">×</button> 
             <strong>{{ $message }}</strong>
     </div>
    @endif
      <a href="{{route('rescuer.create')}}" class="btn btn-primary a-btn-slide-text">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        <span><strong>ADD RESCUER</strong></span>            
    </a>
<div class="table-responsive">
<table id ="rescuer-table" class="table table-striped table-hover">
    <thead>
      <tr>
        <th>Rescuer ID</th>
        <th>Rescuer Firstname</th>
        <th>Rescuer Lastname</th>
        <th>Rescuer Age</th>
        <th>Rescuer Address</th>
        <th>Rescuer Contact</th>
        <th>Rescuer Email</th>
 {{--        <th>Rescued Animal Name</th> --}}
        <th>Action</th>

        </tr>
    </thead>

{{-- 
      @foreach($rescuers as $rescuer)
      <tr>
    <td>{{$rescuer->id}}</td>
          <td><a href="{{route('rescuer.show',$rescuer->id)}}">{{$rescuer->rescuer_Fname}}</a></td>
          <td>{{$rescuer->rescuer_Lname}}</td>
          <td>{{$rescuer->rescuer_Age}}</td>
          <td>{{$rescuer->rescuer_Address}}</td>
          <td>{{$rescuer->rescuer_Contact}}</td>
          <td>{{$rescuer->rescuer_Email}}</td>  --}}
          {{-- <td>
            @foreach($animal_rescuers as $animal) 
              @if($rescuer->id == $animal->rescuer_id)
               {{$animal->animal_Name}}
              <br>
              @endif
            @endforeach
            
          </td>  --}} 

          {{-- <td>
            @foreach($rescuer->animals as $animal)
              <li>{{$animal->animal_Name}}</li>
            @endforeach
          </td>
          
          <td align="center"><a href="{{route('rescuer.edit',$rescuer->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:24px" ></a></i></td>

          <td align="center">
            <form action="{{route('rescuer.destroy',$rescuer->id) }}" method = "POST">
            @csrf
            @method('DELETE')
            <button><i class="fa fa-trash-o" style="font-size:24px; color:red"></i></button>
            </form>
          </td>
      
      @endforeach
    </tr>
    </tbody> --}}
  </table>
</div>
</div>
@endsection
@section('scripts')
  <script >
    $(document).ready(function() 
    {
      $('#rescuer-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('rescuer.getRescuer') !!}',
            columns: [
              { data: 'id', name: 'id' },
              { data: 'rescuer_Fname', name: 'rescuer_Fname' },
              { data: 'rescuer_Lname', name: 'rescuer_Lname' },
              { data: 'rescuer_Age', name: 'rescuer_Age' },
              { data: 'rescuer_Address', name: 'rescuer_Address' },
              { data: 'rescuer_Contact', name: 'rescuer_Contact' },
              { data: 'rescuer_Email', name: 'rescuer_Email' },
              { data: 'action', name: 'action', orderable: false},
             ]
        });
  });

  </script>
  @endsection
