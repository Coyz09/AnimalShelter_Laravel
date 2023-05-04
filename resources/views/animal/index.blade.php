@extends('layouts.base')
@section('body')

<div class="container">   
<h2>Animals</h2>
    @if ($message = Session::get('success'))
     <div class="alert alert-success alert-block">
     <button type="button" class="close" data-dismiss="alert">×</button> 
             <strong>{{ $message }}</strong>
     </div>
    @endif
     <a href="{{route('animal.create')}}" class="btn btn-primary a-btn-slide-text">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        <span><strong>ADD ANIMAL</strong></span>            
    </a>
<div class="table-responsive">
<table id="animal-table" class="table table-striped table-hover">
    <thead>
      <tr>
        <th>Animal ID</th>
        <th>Animal Name</th>
        <th>Animal Type</th>
        <th>Animal Breed</th>
        <th>Animal Age</th>
        <th>Animal Rescue Place</th>
        <th>Animal Rescue Date</th>
        <th>Adoption Status</th>
        <th>Animal Image</th>
        <th>Action</th>
        </tr>
    </thead>

   {{--  <tbody>

         @foreach($animals as $animal) 
      <tr>

          <td>{{$animal->id}}</td>
          <td><a href="{{route('animal.show',$animal->id)}}">{{$animal->animal_Name}}</a></td>
          <td>{{$animal->animal_Type}}</td>
          <td>{{$animal->animal_Breed}}</td>
          <td>{{$animal->animal_Age}}</td>
          <td>{{$animal->animal_Rescueplace}}</td>  
          <td>{{$animal->animal_Rescuedate}}</td> 
          <td>{{$animal->adoption_Status}}</td> 
          <td><img src="{{asset($animal->animal_Image)}}" width="100px" height="100px"></td>
           
          <td>
            @foreach($animal_injuries as $injury) 
              @if($animal->id == $injury->animal_id)
              {{$injury->injury_Name}}
              <br>
              @endif
            @endforeach
             @if($animal->id != $injury->animal_id)
                {{'Healthy'}}
             @endif
            
          </td> 

          <td>
            @foreach($animal->injuries as $injury)
              <li>{{$injury->injury_Name}}</li>
            @endforeach
            @if($animal->id != $injury->animal_id)
                {{'Healthy'}}
             @endif
          </td>
       
        
          <td align="center"><a href="{{route('animal.edit',$animal->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:24px" ></a></i></td>
          
          <td align="center">
            <form action="{{route('animal.destroy',$animal->id) }}" method = "POST">
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
      $('#animal-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('animal.getAnimal') !!}',
            columns: [
              { data: 'id', name: 'id' },
              { data: 'animal_Name', name: 'animal_Name' },
              { data: 'animal_Type', name: 'animal_Type' },
              { data: 'animal_Breed', name: 'animal_Breed' },
              { data: 'animal_Age', name: 'animal_Age' },
              { data: 'animal_Rescueplace', name: 'animal_Rescueplace' },
              { data: 'animal_Rescuedate', name: 'animal_Rescueplace' },
              { data: 'adoption_Status', name: 'adoption_Status' },
              { data: 'animal_Image', name: 'animal_Image',
              "render": function (data, type, full, meta) {
                  return "<img src=\"" + data + "\" height=\"100\" width=\"100\"/>";
              },orderable: false},
              { data: 'action', name: 'action', orderable: false},
             ]
        });
  });

  </script>
  @endsection