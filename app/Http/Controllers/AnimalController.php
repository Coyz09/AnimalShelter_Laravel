<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Redirect;
use DB;
use Validator;
use App\Models\Animal;
use App\Models\Injury;
use App\Models\Rescuer;
use App\Models\Adopter;
use Yajra\Datatables\Datatables;
use Event;
use App\Events\RescuerCreated;

class AnimalController extends Controller
{
    public function index()
    {
     // $animals = Animal::orderBy('id','ASC')->get();

     // $animals =  DB::table('animals')
     //        // ->join('animals','injuries.id','animals.injury_ID')
     //        ->select('animals.*')
     //        ->get();

     // $animal_injuries = DB::table('animals')
     //        ->leftJoin('animal_injury','animal_injury.animal_id','=','animals.id')
     //        ->leftJoin('injuries','injuries.id','=','animal_injury.injury_id')
     //        ->select('animal_injury.animal_id','injuries.injury_Name')
     //        ->get();  
      // ,'animal_injuries'
       // $animals = Animal::with('injuries')->get();


      // $comment = DB::table('comments')
      //       ->leftJoin($animal,'=','comments.animal_id')
      //       ->select('comments.name','comments.comment')
      //       ->get();  

     return View::make('animal.index');
    }

    public function getAnimal(){

      $animals = Animal::with('injuries')->select('*');

      return  Datatables::of($animals) 
      ->addColumn('action', 'animal.action')
      ->make();
    }

    public function create()
    { 
        $injuries = Injury::pluck('injury_Name','id');
       return View::make('animal.create',compact('injuries'));
    }

    public function store(Request $request)
    {   
      $rules =[
        'animal_Name' => 'required|alpha|min:2|max:20',
        'animal_Type' => 'required',
        'animal_Breed' => 'required',
        'animal_Age' => 'numeric|min:1|max:99',
        'animal_Rescueplace' => 'required',
        'animal_Rescuedate' => 'required',
        'animal_Image' => 'required|image|mimes:jpg,png,gif,jpeg,jfif,svg|max:2048',
      ];

      $messages = [
        'required' => '*Field Empty',
        'min' => '*Too Short!',
        'numeric' => '*Numbers Only',
        'animal_Name.required' => '*Animal Name Required',
      ];

      $validator = Validator::make($request->all(), $rules,$messages);
      if($validator->fails())
      {
        return redirect()->back()->withInput()->withErrors($validator);
         
      }
      else{

        $input = $request->all();
        if($request->hasFile('animal_Image')){
            $animal_image = $request->file('animal_Image')->getClientOriginalName();
            $request->file('animal_Image')->storeAs('public/images', $animal_image);
            $input['animal_Image'] = 'storage/images/'.$animal_image;
        }

            if(empty($request->input('injury_id'))){
                 $animal = Animal::create($input);
                 Event::dispatch(new RescuerCreated( $animal));
            }
            else {
              $animal = Animal::create($input); 
                foreach ($request->injury_id as $injury_id) {      
                    DB::table('animal_injury')->insert(
                        [ 'injury_id' => $injury_id,
                          'animal_id' => $animal->id ]
                        );
                       }
              Event::dispatch(new RescuerCreated( $animal));
              }

              $first = DB::table('animals')->latest()->first();
              if(empty($request->injury_id)){
                  $adopt = Animal::find($first->id);
                  $adopt ->adoption_Status='Adoptable';

                  $adopt ->save();
              } 
              else {
                  $adopt = Animal::find($first->id);
                  $adopt ->adoption_Status='Treating';
                  $adopt ->save();
              }
          
        return Redirect::to('animal')->with('success','New Animal added!');  
      }
    }

    public function show($id)
    {
       $animal_injuries = DB::table('animals')
            ->leftJoin('animal_injury','animal_injury.animal_id','=','animals.id')
            ->leftJoin('injuries','injuries.id','=','animal_injury.injury_id')
            ->select('animal_injury.animal_id','injuries.injury_Name')
            ->get();  
        $animal = Animal::find($id);      
        return View::make('animal.show',compact('animal','animal_injuries'));
    }

    public function edit($id)
    {
        $animals = DB::table('animals')
            ->join('animal_injury','animal_injury.animal_id','=','animals.id')
            ->join('injuries','injuries.id','=','animal_injury.injury_id')
            ->select('animals.id','animals.animal_Name','injuries.injury_Name','animal_injury.injury_id')
            ->where('animals.id',$id)
            ->toSql();

        $animal_injury =  DB::table('animal_injury')->where('animal_id',$id)->pluck('injury_id')->toArray();
        $animal = Animal::find($id);
        $injuries = Injury::pluck('injury_Name','id');
        return View::make('animal.edit',compact('animal','injuries','animal_injury','animals'));
    }

    public function update(Request $request, $id)
    {   
      $rules =[
        'animal_Name' => 'required|alpha|min:2|max:20',
        'animal_Type' => 'required',
        'animal_Breed' => 'required',
        'animal_Age' => 'numeric|min:1|max:99',
        'animal_Rescueplace' => 'required',
        'animal_Rescuedate' => 'required',
        'animal_Image' => 'required|image|mimes:jpg,png,gif,jpeg,jfif,svg|max:2048',
      ];

      $messages = [
        'required' => '*Field Empty',
        'min' => '*Too Short!',
        'numeric' => '*Numbers Only',
        'animal_Name.required' => '*Animal Name Required',
      ];

      $validator = Validator::make($request->all(), $rules,$messages);
      if($validator->fails())
      {
        return redirect()->back()->withInput()->withErrors($validator);
         
      }
      else{
        $input = $request->all();
        $animal = Animal::find($id);           
        $injury_ids = $request->input('injury_id');

       if($request->hasFile('animal_Image')){
            $animal_image = $request->file('animal_Image')->getClientOriginalName();
            $request->file('animal_Image')->storeAs('public/images', $animal_image);
            $input['animal_Image'] = 'storage/images/'.$animal_image;
        }

        if(empty($injury_ids)){
        DB::table('animal_injury')->where('animal_id',$id)->delete();
        } 
        else {    
            foreach($injury_ids as $injury_id) {
                 DB::table('animal_injury')->where('animal_id',$id)->delete();
             }
            foreach($injury_ids as $injury_id) {
                DB::table('animal_injury')->insert(['injury_id' => $injury_id, 'animal_id' => $id]); 
             }
        }

         if(empty($injury_id)){
            $animal->adoption_Status='Adoptable';
            $animal->save();
        } 
        else {
            $animal->adoption_Status='Treating';
            $animal->save();
        }
         $animal->update($input);
         return Redirect::to('animal')->with('success','Animal updated!');
       }
    }

    public function destroy($id)
    {
         DB::table('animal_injury')->where('animal_id',$id)->delete();
         DB::table('animal_rescuer')->where('animal_id',$id)->delete();
         DB::table('adopter_animal')->where('animal_id',$id)->delete();
         $animal = Animal::find($id);
         $animal->delete();
         return Redirect::to('animal')->with('success','Animal deleted!');
    }
}


