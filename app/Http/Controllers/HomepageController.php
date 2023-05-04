<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Redirect;
use DB;
use App\Models\Animal;
use App\Models\Injury;
use App\Models\Comment;
use Session;
use Validator;
use Askedio\Laravel5ProfanityFilter\ProfanityFilter;

class HomepageController extends Controller
{
     public function front()
    {
      
      $animals = DB::table('animals')
        ->select('animals.*')
        ->where('adoption_Status','Adoptable')->get();
        return view('homepage.front',compact('animals'));
    }
     public function animals(){

        $search = request()->query('search');

        if($search){
             $animals = Animal::where('adoption_Status','LIKE', "%{$search}%")->simplePaginate(5);
             $animal_injuries = DB::table('animals')
            ->leftJoin('animal_injury','animal_injury.animal_id','=','animals.id')
            ->leftJoin('injuries','injuries.id','=','animal_injury.injury_id')
            ->select('animal_injury.animal_id','injuries.injury_Name')
            ->get(); 
             return view('homepage.animals',compact('animals','animal_injuries'));
         }

		$animal_injuries = DB::table('animals')
            ->leftJoin('animal_injury','animal_injury.animal_id','=','animals.id')
            ->leftJoin('injuries','injuries.id','=','animal_injury.injury_id')
            ->select('animal_injury.animal_id','injuries.injury_Name')
            ->get();  


        $animals = DB::table('animals')
        ->select('animals.*')
        ->whereIn('adoption_Status',['Adoptable','Treating','Adopted'])->get();
        
 		 return view('homepage.animals',compact('animals','animal_injuries'));
  
    }


    public function adopters(){
        $adopters = DB::table('adopters')
        ->select('adopters.*')
        ->orderBy('id','ASC')->get();

        $adopter_animals = DB::table('adopters')
        ->leftJoin('adopter_animal','adopter_animal.adopter_id','=','adopters.id')
        ->leftJoin('animals','animals.id','=', 'adopter_animal.animal_id')
        ->select('adopter_animal.adopter_id','animals.animal_Name')
        ->get();

    
        return view('homepage.adopters',compact('adopters','adopter_animals'));
    }

 public function animalshow($id)
    {
       $animal_injuries = DB::table('animals')
            ->leftJoin('animal_injury','animal_injury.animal_id','=','animals.id')
            ->leftJoin('injuries','injuries.id','=','animal_injury.injury_id')
            ->select('animal_injury.animal_id','injuries.injury_Name')
            ->get();  
        $animal = Animal::find($id); 
       

        $comment = Comment::with('animals')->get();
        return View::make('homepage.animalshow',compact('animal','animal_injuries','comment'));
    }
    
    public function postComment(Request $request)
    {
        
        $this->validate($request,array(
            'name'=>'required|max:255',
            'email'=>'required|email|max:255',
            'comment'=>'required|min:3|max:3000|profanity'
            ));

       $comments = new Comment([
        'name' => $request->get('name'),
        'email' => $request->get('email'),
        'comment' => $request->get('comment'),
        'animal_id' => $request->get('animal_id')
        ]);  
       
        
        $comments ->save();
        
        Session::flash('success','Comment was added');

        return redirect()->route('homepage.animals');

    }
}
