<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Redirect;
use DB;
use Validator;
use App\Models\Animal;
use App\Models\Rescuer;
use Yajra\Datatables\Datatables;

class RescuerController extends Controller
{
    public function index()
    {
        // $rescuers = Rescuer::orderBy('id','ASC')->get();

        // $rescuers =  DB::table('rescuers')
        //     ->select('rescuers.*')
        //     ->get();

        // $animal_rescuers = DB::table('rescuers')
        //     ->leftJoin('animal_rescuer','animal_rescuer.rescuer_id','=','rescuers.id')
        //     ->leftJoin('animals','animals.id','=','animal_rescuer.animal_id')
        //     ->select('animal_rescuer.rescuer_id','animals.animal_Name')
        //     ->get();  ,'animal_rescuers'
        // $rescuers = Rescuer::with('animals')->get();

        return View::make('rescuer.index');
    }

    public function getRescuer(){

        // $adopters = Adopter::select('*');
        $rescuers = Rescuer::with('animals')->select('*');

      // dd($adopters);
      return  Datatables::of($rescuers) 
      ->addColumn('action', 'rescuer.action')
      ->make();
    }

    public function create()
    {   
        $animals = Animal::pluck('animal_Name','id');
        return View::make('rescuer.create',compact('animals'));
    }

    public function store(Request $request)
    {

         $rules =[
        'rescuer_Fname' => 'required|alpha|min:2|max:20',
        'rescuer_Lname' => 'required|alpha|min:2|max:20',
        'rescuer_Age' => 'numeric|min:1|max:99',
        'rescuer_Address' => 'required|min:5|max:1000',
        'rescuer_Contact' => 'numeric',
        'rescuer_Email' => 'required|email',
          ];

          $messages = [
            'required' => '*Field Empty',
            'min' => '*Too Short!',
            'max' => '*Too Long!', 
            'numeric' => '*Numbers Only',
            'rescuer_Fname.required' => '*Rescuer First Name Required',
            'rescuer_Lname.required' => '*Rescuer Last Name Required',
          ];

      $validator = Validator::make($request->all(), $rules,$messages);
      if($validator->fails())
      {
        return redirect()->back()->withInput()->withErrors($validator);
         
      }
      else{
        $input = $request->all();
        if(empty($request->input('animal_id'))){
                 $rescuer = Rescuer::create($input);
            }
            else {
              $rescuer = Rescuer::create($input);
                foreach ($request->animal_id as $animal_id) {      
                    DB::table('animal_rescuer')->insert(
                        [ 'animal_id' => $animal_id,
                          'rescuer_id' => $rescuer->id ]
                        );
                       }
              }  
       
       return Redirect::to('rescuer')->with('success','New Rescuer added!');
        }
    }

    public function show($id)
    { 
        $animal_rescuers = DB::table('rescuers')
            ->leftJoin('animal_rescuer','animal_rescuer.rescuer_id','=','rescuers.id')
            ->leftJoin('animals','animals.id','=','animal_rescuer.animal_id')
            ->select('animal_rescuer.rescuer_id','animals.animal_Name')
            ->get();  
        $rescuer = Rescuer::find($id);  
        return View::make('rescuer.show',compact('rescuer','animal_rescuers'));
    }

    public function edit($id)
    {
       
        $rescuers = DB::table('rescuers')
            ->join('animal_rescuer','animal_rescuer.rescuer_id','=','rescuers.id')
            ->join('animals','animals.id','=','animal_rescuer.animal_id')
            ->select('rescuers.id','rescuers.rescuer_Fname','animals.animal_Name','animal_rescuer.animal_id')
            ->where('rescuers.id',$id)
            ->toSql();

        $animal_rescuer = DB::table('animal_rescuer')->where('rescuer_id',$id)->pluck('animal_id')->toArray();
        $rescuer = Rescuer::find($id);
        $animals = Animal::pluck('animal_Name','id');
        return View::make('rescuer.edit',compact('rescuer','animals','animal_rescuer','rescuers'));
    }

    public function update(Request $request, $id)
    {
         $rules =[
                'rescuer_Fname' => 'required|alpha|min:2|max:20',
                'rescuer_Lname' => 'required|alpha|min:2|max:20',
                'rescuer_Age' => 'numeric|min:1|max:99',
                'rescuer_Address' => 'required|min:5|max:1000',
                'rescuer_Contact' => 'numeric',
                'rescuer_Email' => 'required|email',
                  ];

          $messages = [
            'required' => '*Field Empty',
            'min' => '*Too Short!',
            'max' => '*Too Long!', 
            'numeric' => '*Numbers Only',
            'rescuer_Fname.required' => '*Rescuer First Name Required',
            'rescuer_Lname.required' => '*Rescuer Last Name Required',
          ];

      $validator = Validator::make($request->all(), $rules,$messages);
      if($validator->fails())
      {
        return redirect()->back()->withInput()->withErrors($validator);
         
      }
      else{
        $input = $request->all();  
        $rescuer = Rescuer::find($id);      
        $animal_ids = $request->input('animal_id');

        if(empty($animal_ids)){
        DB::table('animal_rescuer')->where('rescuer_id',$id)->delete();
        } 
        else {    
            foreach($animal_ids as $animal_id) {
                 DB::table('animal_rescuer')->where('rescuer_id',$id)->delete();
             }
            foreach($animal_ids as $animal_id) {
                DB::table('animal_rescuer')->insert(['animal_id' => $animal_id, 'rescuer_id' => $id]); 
             }
        }          
        $rescuer->update($input);
        return Redirect::to('rescuer')->with('success','Rescuer updated!');
        }

    }

    public function destroy($id)
    {
        DB::table('animal_rescuer')->where('rescuer_id',$id)->delete();
        $rescuer = Rescuer::find($id);
        $rescuer->delete();
        return Redirect::to('rescuer')->with('success','Rescuer deleted!');
    }
}
