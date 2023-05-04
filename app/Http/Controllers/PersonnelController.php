<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Redirect;
use Validator;
use DB;
use Auth;
use App\Models\Personnel;
use App\Models\User;
use Yajra\Datatables\Datatables;

class PersonnelController extends Controller
{
    public function index()
    {
        $personnel = Personnel::orderBy('id','ASC')->get();
        return View::make('personnel.index',compact('personnel'));
    }

    public function getPersonnel(){

      $personnels = Personnel::with('animals')->select('*');

      return  Datatables::of($personnels) 
      ->addColumn('action', 'personnel.action')
      ->make();
    }

    public function create()
    {
        return View::make('personnel.create');
    }


    public function store(Request $request)
    {
        $rules =[
                'personnel_Fname' => 'required|alpha|min:2|max:20',
                'personnel_Lname' => 'required|alpha|min:2|max:20',
                'personnel_Job' => 'required',
                'personnel_Contact' => 'numeric',

                  ];

          $messages = [
            'required' => '*Field Empty',
            'min' => '*Too Short!',
            'max' => '*Too Long!', 
            'numeric' => '*Numbers Only',
            'personne_Fname.required' => '*Personnel First Name Required',
            'personne_Lname.required' => '*Personnel Last Name Required',
          ];

      $validator = Validator::make($request->all(), $rules,$messages);
      if($validator->fails())
      {
        return redirect()->back()->withInput()->withErrors($validator);
         
      }
      else{
        Personnel::create($request->all());
        return Redirect::to('personnel')->with('success','New Personnel added!');
        }
    }


    public function show($id)
    {
        $personnel = Personnel::find($id); 
        return View::make('personnel.show',compact('personnel'));
    }


    public function edit($id)
    {
        $personnel = Personnel::find($id);
        return View::make('personnel.edit',compact('personnel'));
    }


    public function update(Request $request, $id)
    {

         $rules =[
                'personnel_Fname' => 'required|alpha|min:2|max:20',
                'personnel_Lname' => 'required|alpha|min:2|max:20',
                'personnel_Job' => 'required',
                'personnel_Contact' => 'numeric',
                  ];

          $messages = [
            'required' => '*Field Empty',
            'min' => '*Too Short!',
            'max' => '*Too Long!', 
            'numeric' => '*Numbers Only',
            'personne_Fname.required' => '*Personnel First Name Required',
            'personne_Lname.required' => '*Personnel Last Name Required',
          ];

      $validator = Validator::make($request->all(), $rules,$messages);
      if($validator->fails())
      {
        return redirect()->back()->withInput()->withErrors($validator);
         
      }
      else{
        $personnel = Personnel::find($id);           
        $personnel->update($request->all());
        return Redirect::to('personnel')->with('success','Personnel updated!');
        }
    }

    public function destroy($id)
    {
        $personnel = Personnel::find($id);
        $personnel->delete();
        return redirect()->route('personnel.index')->with('success','Personnel deleted!');
    }


    public function updateStatus(Request $request, $user_id)
    {

        $personnel = Personnel::with('users')->find($user_id);
   
   $admins = DB::table('users')
        ->select('*')
        ->where('id', $user_id)
        ->get();
     
try {
          if($admins->role = "personnel"){
      
            $admin = DB::table('users')
            ->where('id', $user_id)
            ->update(array('role'=> "deactivated"));
            return redirect()->route('personnel.index');
          }       
         }
          catch (Exception $e) {

             return redirect()->route('personnel.index')->with('error', $e->getMessage());
        }
      
    }
  
  


   public function statusUpdate(Request $request, $user_id)
    {

        $personnel = Personnel::with('users')->find($user_id);

    $personnels = DB::table('personnels')
        ->select('*')
        ->where('user_id', $user_id)
        ->get();
  

        try {
          
          if($personnels->status = 1){
            $admin = DB::table('users')
            ->where('id', $user_id)
            ->update(array('role'=> "personnel"));
            return redirect()->route('personnel.index');
          } 
            }
          catch (Exception $e) {

             return redirect()->route('personnel.index')->with('error', $e->getMessage());
        }
      
    }
  
  }