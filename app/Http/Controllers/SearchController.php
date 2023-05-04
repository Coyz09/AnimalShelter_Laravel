<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\Search;
use App\Models\Animal;

class SearchController extends Controller
{
    public function search(Request $request)
    {
    	$searchResults = (new Search())

		   ->registerModel(Animal::class, 'animal_Name','animal_Type','animal_Breed')
		   ->search($request->input('search'));

	   // dd($searchResults);

	   return view('search',compact('searchResults'));
    }
}
