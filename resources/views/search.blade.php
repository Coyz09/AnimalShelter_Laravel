@extends('layouts.front')
@section('title')
  Search
@endsection
@section('body')
<div class="container">   
<h1>Search</h1>
   
<div class="col-md-2"  style="margin-top:30px"></div>
<h2>There are {{ $searchResults->count() }} results:</h2>

@foreach($searchResults->groupByType() as $type => $modelSearchResults)
   <h2>{{ $type }}</h2>
   
   @foreach($modelSearchResults as $searchResult)
       <ul>
       {{--  {{dd($searchResult)}} --}}
            <li><a href="{{ $searchResult->url }}">{{ $searchResult->title }}</a>
              {{-- {{$searchResult->searchable->item->cost_price}} --}}
            </li>
       </ul>
   @endforeach
@endforeach
</div>
@endsection