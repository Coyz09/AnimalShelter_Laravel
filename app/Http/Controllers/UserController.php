<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Adopter;
use App\Models\Rescuer;
use App\Models\Animal;
use View;
use Validator;
use Mail;
use App\Mail\VerifyEmail;
use DB;
use Event;
use App\Events\RescuerCreated;
use Carbon\Carbon;

class UserController extends Controller
{
    public function getSignup(){
        return view('user.signup');
    }

     public function postSignup(Request $request){
        $this->validate($request, [
            'fname' => 'required| min:4',
            'email' => 'email|required|unique:users',
            'password' => 'required| min:4'
        ]);
         $user = new User([
            'name' => $request->input('fname').' '.$request->lname,
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => 'user',
        ]);
         $user->save();

         Auth::login($user);
         return redirect()->route('user.profile');
    }
   
    public function emailAdopter(Request $request, $id){
   
         $admin = User::where('id', $id)->first();
          $admin = DB::table('users')
            ->where('id',$id)
            ->update(array('email_verified_at' => Carbon::now()));

        return redirect()->route('user.signin')
        ->with('success','Email Successfully Verified.');
    }

     public function getAdoptersignup(){
       $animals = Animal::pluck('animal_Name','id');
        return view('user.adoptersignup',compact('animals'));
    }

     public function postAdoptersignup(Request $request){
         $data = request()->validate([
            'fname' => 'required| min:4',
            'email' => 'email|required|unique:users',
            'password' => 'required| min:4'
        ]);
         $user = new User([
            'name' => $request->input('fname').' '.$request->lname,
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => 'adopter',
        ]);
         $user->save();
         $adopter = new Adopter;
           $adopter->adopter_Fname = $request->fname;
           $adopter->adopter_Lname = $request->lname;
           $adopter->adopter_Address = $request->address;
           $adopter->adopter_Contact = $request->contact;
           $adopter->adopter_Email = $request->email;
           $adopter->user_id = $user->id;
           $adopter->save();
            foreach ($request->animal_id as $animal_id) {    
                    Animal::where('id',$animal_id)->update(array('adoption_Status'=>'Adopted'));  
                    DB::table('adopter_animal')->insert(
                        [ 'animal_id' => $animal_id,
                          'adopter_id' => $adopter->id ]
                        );
                       }

           Mail::to('admin@animalshelter.com')->send(new VerifyEmail($user));
         return redirect()->route('user.signin')
          ->with('success','Email Successfully Sent.Please verify!');
    }

    public function getRescuersignup(){
      $animals = Animal::pluck('animal_Name','id');
        return view('user.rescuersignup',compact('animals'));
    }

     public function postRescuersignup(Request $request){
         $data = request()->validate([
            'fname' => 'required| min:4',
            'email' => 'email|required|unique:users',
            'password' => 'required| min:4'
        ]);
         $user = new User([
            'name' => $request->input('fname').' '.$request->lname,
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => 'rescuer',
        ]);
         $user->save();
         $rescuer = new Rescuer;
           $rescuer->rescuer_Fname = $request->fname;
           $rescuer->rescuer_Lname = $request->lname;
           $rescuer->rescuer_Age = $request->age;
           $rescuer->rescuer_Address = $request->address;
           $rescuer->rescuer_Contact = $request->contact;
           $rescuer->rescuer_Email = $request->email;
           $rescuer->user_id = $user->id;
           $rescuer->save();

            foreach ($request->animal_id as $animal_id) {      
                DB::table('animal_rescuer')->insert(
                   [ 'animal_id' => $animal_id,
                      'rescuer_id' => $rescuer->id ]
                    );
                  }
     

        Event::dispatch(new RescuerCreated( $rescuer));
         return redirect()->route('user.signin')
          ->with('success','Rescuer Successfully registered.');
    }


     public function getSignin(){
        return view('user.signin');
     }

    public function getLogout(){
        Auth::logout();
        return redirect()->guest('/');
    }

     public function showUser()
    {   
        $admin = User::where('id',Auth::id())->first(); 
        return View::make('user.profile',compact('admin'));
    }

     public function editUser($admin)
    {
       
        $admin = User::where('id',Auth::id())->first();

        return View::make('user.edit',compact('admin'));
    }


    public function updateUser(Request $request,$admin)
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

        return redirect()->route('user.profile');
        }
    }

}
