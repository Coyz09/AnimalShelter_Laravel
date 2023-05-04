<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Redirect;
use DB;
use Validator;
use App\Models\Adopter;
use App\Models\Animal;
use Yajra\Datatables\Datatables;

class AdopterController extends Controller
{
   public function index()
    {
        // $adopters = Adopter::orderBy('id','ASC')->get();

        // $adopters =  DB::table('adopters')
        //     ->select('adopters.*')
        //     ->get();

        // $adopter_animals = DB::table('adopters')
        //     ->leftJoin('adopter_animal','adopter_animal.adopter_id','=','adopters.id')
        //     ->leftJoin('animals','animals.id','=','adopter_animal.animal_id')
        //     ->select('adopter_animal.adopter_id','animals.animal_Name')
        //     ->get(); 
        // ,'adopter_animals'
        // $adopters = Adopter::with('animals')->get();

        return View::make('adopter.index');

    }

     public function getAdopter(){

        // $adopters = Adopter::select('*');
        $adopters = Adopter::with('animals')->select('*');

      // dd($adopters);
      return  Datatables::of($adopters) 
      ->addColumn('action', 'adopter.action')
      ->make();
    }

    public function create()
    {
        $animals = Animal::pluck('animal_Name','id');
        return View::make('adopter.create',compact('animals'));
    }

    public function store(Request $request)
    {

        $rules =[
        'adopter_Fname' => 'required|alpha|min:2|max:20',
        'adopter_Lname' => 'required|alpha|min:2|max:20',
        'adopter_Address' => 'required|min:5|max:1000',
        'adopter_Contact' => 'numeric',
        'adopter_Email' => 'required|email',
          ];

          $messages = [
            'required' => '*Field Empty',
            'min' => '*Too Short!',
            'max' => '*Too Long!', 
            'numeric' => '*Numbers Only',
            'adopter_Fname.required' => '*Adopter First Name Required',
            'adopter_Lname.required' => '*Adopter Last Name Required',
          ];

      $validator = Validator::make($request->all(), $rules,$messages);
      if($validator->fails())
      {
        return redirect()->back()->withInput()->withErrors($validator);
         
      }
      else{
         $input = $request->all();
        
            if(empty($request->input('animal_id'))){
                 $adopter = Adopter::create($input);
            }
            else {
              $adopter = Adopter::create($input);
                foreach ($request->animal_id as $animal_id) {    
                    Animal::where('id',$animal_id)->update(array('adoption_Status'=>'Adopted'));  
                    DB::table('adopter_animal')->insert(
                        [ 'animal_id' => $animal_id,
                          'adopter_id' => $adopter->id ]
                        );
                       }
              }  
        return Redirect::to('adopter')->with('success','New Adopter added!');
        }
    }

    public function show($id)
    {
        $adopter_animals = DB::table('adopters')
            ->leftJoin('adopter_animal','adopter_animal.adopter_id','=','adopters.id')
            ->leftJoin('animals','animals.id','=','adopter_animal.animal_id')
            ->select('adopter_animal.adopter_id','animals.animal_Name')
            ->get(); 
        $adopter = Adopter::find($id); 
        return View::make('adopter.show',compact('adopter','adopter_animals'));
    }

    public function edit($id)
    {

        $adopters = DB::table('adopters')
            ->join('adopter_animal','adopter_animal.adopter_id','=','adopters.id')
            ->join('animals','animals.id','=','adopter_animal.animal_id')
            ->select('adopters.id','adopters.adopter_Fname','animals.animal_Name','adopter_animal.animal_id')
            ->where('adopters.id',$id)
            ->toSql();

        $adopter_animal =  DB::table('adopter_animal')->where('adopter_id',$id)->pluck('animal_id')->toArray();
        $adopter = Adopter::find($id);
        $animals = Animal::pluck('animal_Name','id');

        return View::make('adopter.edit',compact('adopter','animals','adopter_animal','adopters'));
    }

    public function update(Request $request, $id)
    {
     
     $rules =[
        'adopter_Fname' => 'required|alpha|min:2|max:20',
        'adopter_Lname' => 'required|alpha|min:2|max:20',
        'adopter_Address' => 'required|min:5|max:1000',
        'adopter_Contact' => 'numeric',
        'adopter_Email' => 'required|email',
          ];

          $messages = [
            'required' => '*Field Empty',
            'min' => '*Too Short!',
            'max' => '*Too Long!', 
            'numeric' => '*Numbers Only',
            'adopter_Fname.required' => '*Adopter First Name Required',
            'adopter_Lname.required' => '*Adopter Last Name Required',
          ];

      $validator = Validator::make($request->all(), $rules,$messages);
      if($validator->fails())
      {
        return redirect()->back()->withInput()->withErrors($validator);
         
      }
      else{
        $input = $request->all();
        $adopter = Adopter::find($id);         
        $animal_ids = $request->input('animal_id');

        if(empty($animal_ids)){
           
        DB::table('adopter_animal')->where('adopter_id',$id)->delete();
        } 
        else {    
            foreach($animal_ids as $animal_id) {
                 DB::table('adopter_animal')->where('adopter_id',$id)->delete();
             }
            foreach($animal_ids as $animal_id) {
                Animal::where('id',$animal_id)->update(array('adoption_Status'=>'Adopted'));
                DB::table('adopter_animal')->insert(['animal_id' => $animal_id, 'adopter_id' => $id]); 
             }
        }
         $adopter->update($input);
         return Redirect::to('adopter')->with('success','Adopter updated!');
        }
    }

    public function destroy($id)
    {
        DB::table('adopter_animal')->where('adopter_id',$id)->delete();
        $adopter = Adopter::find($id);
        $adopter->delete();
        return Redirect::to('adopter')->with('success','Adopter deleted!');    
    }
}


