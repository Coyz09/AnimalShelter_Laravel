<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Redirect;
use Validator;
use App\Models\Injury;


class InjuryController extends Controller
{
     public function index()
    {
     // $injuries = Injury::orderBy('id','ASC')->get();
     return View::make('injury.index');
    }

     public function getInjury(){
        $injuries = Injury::select('id', 'injury_Name');

      return  Datatables::of($injuries)
      ->addColumn('action', 'injury.action')
      ->make();
    }

    public function create()
    {
       return View::make('injury.create');
    }

    public function store(Request $request)
    {   
          $rules =[
        'injury_Name' => 'required|min:2|max:1000',
          ];

          $messages = [
            'required' => '*Field Empty',
            'injury_Name.required' => '*Injury Name Required',
          ];

      $validator = Validator::make($request->all(), $rules,$messages);
      if($validator->fails())
      {
        return redirect()->back()->withInput()->withErrors($validator);
         
      }
      else{
         Injury::create($request->all());
        return Redirect::to('injury')->with('success','New Injury added!');
         }
    }

    public function show($id)
    {
        $injury = Injury::find($id);
        
        return View::make('injury.show',compact('injury'));
    }

    public function edit($id)
    {
        $injury = Injury::find($id);
        return View::make('injury.edit',compact('injury'));
    }

    public function update(Request $request, $id)
    {
        $rules =[
        'injury_Name' => 'required|min:2|max:1000',
          ];

          $messages = [
            'required' => '*Field Empty',
            'injury_Name.required' => '*Injury Name Required',
          ];

      $validator = Validator::make($request->all(), $rules,$messages);
      if($validator->fails())
      {
        return redirect()->back()->withInput()->withErrors($validator);
         
      }
      else{
          $injury = Injury::find($id);           
          $injury->update($request->all());
         return Redirect::to('injury')->with('success','Injury updated!');
        }
    }

    public function destroy($id)
    {
         $injury = Injury::find($id);
         $injury->delete();
         return Redirect::to('injury')->with('success','Injury deleted!');
    }
}

