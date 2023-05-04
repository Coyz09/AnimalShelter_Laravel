<!-- resources/views/index.blade.php -->
@extends('layouts.base')
@section('body')
<div class="container">
<h2>Personnels</h2>
    @include('layouts.flash-messages')
    <a href="{{route('personnel.create')}}" class="btn btn-primary a-btn-slide-text">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        <span><strong>ADD PERSONNEL</strong></span>            
    </a>

<div class="table-responsive">
<table id="personnel-table" class="table table-striped table-hover">
    <thead>
      <tr>
        <th>Personnel ID</th>
        <th>Personnel First Name</th>
        <th>Personnel Last Name</th>
        <th>Personnel Job</th>
        <th>Personnel Contact</th>
        {{-- <th>Personnel Status</th> --}}
        <th>Action</th>
        </tr>
    </thead>

{{-- 
      @foreach($personnels as $personnel)
      <tr>
          <td>{{$personnel->id}}</td>
          <td><a href="{{route('personnel.show',$personnel->id)}}">{{$personnel->personnel_Fname}}</a></td>
          <td>{{$personnel->personnel_Lname}}</td>
          <td>{{$personnel->personnel_Job}}</td>
          <td>{{$personnel->personnel_Contact}}</td>
          
          <td align="center"><a href="{{route('personnel.edit',$personnel->id) }}">
            <i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:24px"></a></i></td>

          <td align="center">
            <form action="{{route('personnel.destroy',$personnel->id) }}" method = "POST">
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
      $('#personnel-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('personnel.getPersonnel') !!}',
            columns: [
              { data: 'id', name: 'id' },
              { data: 'personnel_Fname', name: 'personnel_Fname' },
              { data: 'personnel_Lname', name: 'personnel_Lname' },
              { data: 'personnel_Job', name: 'personnel_Job' },
              { data: 'personnel_Contact', name: 'personnel_Contact' },
              // { data: 'status', name: 'status' },
              { data: 'action', name: 'action', orderable: false},
             ]
        });
  });

  </script>
  @endsection

