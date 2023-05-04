<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rescuer;
use App\Models\Animal;
use App\Models\Adopter;
use App\Models\Personnel;
use App\Models\User;
use Auth;
use View;
use DB;
use Validator;
use Redirect;

class ProfileController extends Controller
{
    public function showRescuer()
    { 
  
      $rescuer = Auth::user()->rescuers;
	    $rescuer = Rescuer::with('animals')->where('user_id',Auth::id())->first();
 	    return view('rescuer.profile',compact('rescuer'));

    }

     public function editrescuer($rescuer)
    {
    	 $rescuer = Rescuer::with('animals')->where('user_id',Auth::id())->first();
        return View::make('rescuer.editprofile',compact('rescuer'));
    }

    public function updaterescuer(Request $request, $rescuers)
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
        $rescuers = Rescuer::with('animals')->where('user_id',Auth::id())->first();      
        $rescuers->update($input);
		return redirect()->route('rescuer.profile');
        }
    }


    public function showAdopter()
    { 
  
       $adopter = Auth::user()->adopters;
	   $adopter = Adopter::with('animals')->where('user_id',Auth::id())->first();
 	  return view('adopter.profile',compact('adopter'));

    }

    public function editadopter($adopter)
    {
    	 $adopter = Adopter::with('animals')->where('user_id',Auth::id())->first();
        return View::make('adopter.editprofile',compact('adopter'));
    }

    public function updateadopter(Request $request, $adopters)
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
        $adopters = Adopter::with('animals')->where('user_id',Auth::id())->first();        
        $adopters->update($input);
        return redirect()->route('adopter.profile');
        }
    }

     public function showPersonnel()
    { 
  
       $personnel = Auth::user()->personnels;
	   $personnel = Personnel::with('animals')->where('id',Auth::id())->first();
 	  return view('personnel.profile',compact('personnel'));
    }

	 public function editpersonnel($personnel)
    {
    	$personnel = Personnel::with('animals')->where('id',Auth::id())->first();
        return View::make('personnel.editprofile',compact('personnel'));
    }


    public function updatepersonnel(Request $request, $personnel)
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
      	$input = $request->all();
        $personnel = Personnel::with('animals')->where('id',Auth::id())->first();
        $personnel->update($input);
        return redirect()->route('personnel.profile');
        }
    }

  // public function showAdmin($admin)
  //   {
  //       $admin = User::where('id',Auth::id())->first();
  //       return View::make('admin.show',compact('admin'));
  //   }

    public function showadmin()
    { 
         $admin = User::where('id',Auth::id())->first(); 
        return View::make('admin.show',compact('admin'));
    }

     public function editAdmin($admin)
    {
       
      // $admin = User::find($id); 
        $admin = User::where('id',Auth::id())->first();

        return View::make('admin.edit',compact('admin'));
    }


    public function updateadmin(Request $request,$admin)
    {
         $input = $request->all();

         $rules =[
            'name' => 'required| min:4',
            'lname' => 'required| min:4',
            'email' => 'email|required',
            'password' => 'required| min:4',
                  ];

          $messages = [
            'required' => '*Field Empty',
            'min' => '*Too Short!',
            'name.required' => '* First Name Required',
            'lname.required' => '* Last Name Required',
            'password.required' => '* Password Required',
          ];

      $validator = Validator::make($request->all(), $rules,$messages);
      if($validator->fails())
      {
        return redirect()->back()->withInput()->withErrors($validator);
         
      }
      else{
      $admin = User::where('id',Auth::id())->first();
      
        $admin->update([
            'name' => $request->input('name').' '.$request->input('lname'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);

        return redirect()->route('admin.show');
        }
    }

}
