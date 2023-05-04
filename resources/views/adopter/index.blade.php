<!-- resources/views/index.blade.php -->
@extends('layouts.base')
@section('body')
<div class="container">
<h2>Adopters</h2>
    @if ($message = Session::get('success'))
     <div class="alert alert-success alert-block">
     <button type="button" class="close" data-dismiss="alert">×</button> 
             <strong>{{ $message }}</strong>
     </div>
    @endif
     <a href="{{route('adopter.create')}}" class="btn btn-primary a-btn-slide-text">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        <span><strong>ADD ADOPTER</strong></span>            
    </a>
<div class="table-responsive">
<table id="adopter-table" class="table table-striped table-hover">
    <thead>
      <tr>
        <th>Adopter ID</th>
        <th>Adopter First Name</th>
        <th>Adopter Last Name</th>
        <th>Adopter Address</th>
        <th>Adopter Contact</th>
        <th>Adopter Email</th>      
        <th>Action</th>
        </tr>
    </thead>
{{-- 

      @foreach($adopters as $adopter)
      <tr>
          <td>{{$adopter->id}}</td>
          <td><a href="{{route('adopter.show',$adopter->id)}}">{{$adopter->adopter_Fname}}</a></td>
          <td>{{$adopter->adopter_Lname}}</td>
          <td>{{$adopter->adopter_Address}}</td>
          <td>{{$adopter->adopter_Contact}}</td>
          <td>{{$adopter->adopter_Email}}</td> 

          <td>
            @foreach($adopter->animals as $animal)
              <li>{{$animal->animal_Name}}</li>
            @endforeach
          </td>

          
          <td align="center"><a href="{{route('adopter.edit',$adopter->id) }}">
            <i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:24px"></a></i></td>

          <td align="center">
            <form action="{{route('adopter.destroy',$adopter->id) }}" method = "POST">
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
      $('#adopter-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('adopter.getAdopter') !!}',
            columns: [
              { data: 'id', name: 'id' },
              { data: 'adopter_Fname', name: 'adopter_Fname' },
              { data: 'adopter_Lname', name: 'adopter_Lname' },
              { data: 'adopter_Address', name: 'adopter_Address' },
              { data: 'adopter_Contact', name: 'adopter_Contact' },
              { data: 'adopter_Email', name: 'adopter_Email' },
              { data: 'action', name: 'action', orderable: false},
             ]
        });
  });

  </script>
  @endsection
