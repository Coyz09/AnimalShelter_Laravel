<!-- resources/views/index.blade.php -->
@extends('layouts.base')

@section('body')
<div class="container">
<h2>Injury and Diseases</h2>
    @if ($message = Session::get('success'))
     <div class="alert alert-success alert-block">
     <button type="button" class="close" data-dismiss="alert">×</button> 
             <strong>{{ $message }}</strong>
     </div>
    @endif
       <a align="center" href="{{route('injury.create')}}" class="btn btn-primary a-btn-slide-text">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        <span><strong>ADD INJURY OR DISEASE</strong></span>            
    </a>

<div class="table-responsive">
<table id="injury-table" class="table table-striped table-hover">
    <thead>
      <tr>
        <th>Injury and Disease ID</th>
        <th>Injury and Disease Type</th>
      
        <th>Action</th>
   {{--      <th>Delete</th> --}}
        </tr>
    </thead>
 {{-- <tbody>

      @foreach($injuries as $injury)
      <tr>
    <td>{{$injury->id}}</td>
          <td><a href="{{route('injury.show',$injury->id)}}">{{$injury->injury_Name}}</a></td>
          
          <td align="center"><a href="{{route('injury.edit',$injury->id) }}">
            <i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:24px"></a></i></td>
            
           <td align="center">
            <form action="{{route('injury.destroy',$injury->id) }}" method = "POST">
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
      $('#injury-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('injury.getInjury') !!}',
            columns: [
              { data: 'id', name: 'id' },
              { data: 'injury_Name', name: 'injury_Name' },
              { data: 'action', name: 'action', orderable: false},
             ]
        });
  });

  </script>
  @endsection

