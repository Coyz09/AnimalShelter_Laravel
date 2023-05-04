<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Auth::routes(['verify' => true]);
Route::get('/front', [App\Http\Controllers\HomepageController::class,'front'])->name('front');
Route::get('/animals', [App\Http\Controllers\HomepageController::class,'animals'])->name('animals');
Route::get('/adopters', [App\Http\Controllers\HomepageController::class,'adopters'])->name('adopters');
// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('contact','ContactFormController@create');
Route::post('contact','ContactFormController@store');


Route::get('/', [
	'uses' => 'HomepageController@front',
	'as' => 'homepage.front'
]);

Route::get('/adopters', [
    'uses' => 'HomepageController@adopters',
    'as' => 'homepage.adopters'
]);

Route::get('/animals', [
    'uses' => 'HomepageController@animals',
    'as' => 'homepage.animals'
]);


Route::fallback(function(){
    return redirect()->back();
});

Route::group(['prefix' => 'user'], function(){
    Route::group(['middleware' => 'guest'], function() {
        Route::get('signup', [
        'uses' => 'userController@getSignup',
        'as' => 'user.signup',
            ]);
        Route::post('signup', [
                'uses' => 'userController@postSignup',
                'as' => 'user.signup',
           ]);
        Route::get('signin', [
                'uses' => 'userController@getSignin',
                'as' => 'user.signin',
            ]);
        Route::post('signin', [
                'uses' => 'LoginController@postSignin',
                'as' => 'user.signin',
         ]);

        Route::get('/adoptersignup', [
       'uses' => 'UserController@getAdoptersignup',
       'as' => 'user.adoptersignup',
        ]);

        Route::post('/adoptersignup', [
       'uses' => 'UserController@postAdoptersignup',
       'as' => 'user.adoptersignup',
        ]);

        Route::get('/rescuersignup', [
       'uses' => 'UserController@getRescuersignup',
       'as' => 'user.rescuersignup',
        ]);

        Route::post('/rescuersignup', [
       'uses' => 'UserController@postRescuersignup',
       'as' => 'user.rescuersignup',
        ]);

        Route::get('/verifyadopter/{id}', [
       'uses' => 'UserController@emailAdopter',
       'as' => 'user.verifyadopter',
        ]);

    });
    Route::group(['middleware' => 'auth'], function() {

   Route::get('logout', [
        'uses' => 'userController@getLogout',
        'as' => 'user.logout',
        ]);
    });

});

Route::group(['middleware' => 'role:admin'], function() {

  Route::resource('adopter', AdopterController::class);
  Route::get('/get-adopter',[ 'uses'=>'AdopterController@getAdopter','as' => 'adopter.getAdopter']);

  Route::resource('rescuer', RescuerController::class);
  Route::get('/get-rescuer',[ 'uses'=>'RescuerController@getRescuer','as' => 'rescuer.getRescuer']);

  Route::resource('injury', InjuryController::class);
  Route::get('/get-injury',[ 'uses'=>'InjuryController@getInjury','as' => 'injury.getInjury']);

  Route::resource('animal', AnimalController::class);
  Route::get('/get-animal',[ 'uses'=>'AnimalController@getAnimal','as' => 'animal.getAnimal']);

  Route::resource('personnel', PersonnelController::class);
  Route::get('/get-personnel',[ 'uses'=>'PersonnelController@getPersonnel','as' => 'personnel.getPersonnel']);

    Route::post('personnelupdate/{user_id}', [
        'uses' => 'PersonnelController@updateStatus',
        'as' => 'status.update',
        ]);

    Route::post('personnelupdates/{user_id}', [
        'uses' => 'PersonnelController@statusUpdate',
        'as' => 'update.status',
        ]);

    // Route::get('checkout',[
    //     'uses' => 'productController@postCheckout',
    //     'as' => 'checkout',
    // ]);

  Route::resource('customer', CustomerController::class);
 
    Route::get('/dashboard',[
    'uses'=>'DashboardController@index',
    'as'=>'dashboard.index',
    ]);

    Route::get('adminprofile', [
        'uses' => 'ProfileController@showadmin',
        'as' => 'admin.show',
     ]);


     Route::get('editadmin/{admin}', [
        'uses' => 'ProfileController@editadmin',
        'as' => 'admin.edit',
     ]);


      Route::post('updateadmin/{admin}',[
        'uses' => 'ProfileController@updateadmin',
        'as' => 'admin.update',
    ]);

   });



Route::group(['middleware' => 'role:rescuer'], function() {
       Route::get('rescuerprofile', [
        'uses' => 'ProfileController@showRescuer',
        'as' => 'rescuer.profile',
     ]);

    Route::get('editrescuer/{rescuer}', [
        'uses' => 'ProfileController@editRescuer',
        'as' => 'rescuer.editprofile',
     ]);

      Route::post('updaterescuer/{rescuers}',[
        'uses' => 'ProfileController@updateRescuer',
        'as' => 'rescuer.updateprofile',
    ]);

});

Route::group(['middleware' => 'role:adopter'], function() {
       Route::get('adopterprofile', [
        'uses' => 'ProfileController@showAdopter',
        'as' => 'adopter.profile',
     ]);

    Route::get('editadopter/{adopter}', [
        'uses' => 'ProfileController@editAdopter',
        'as' => 'adopter.editprofile',
     ]);

      Route::post('updateadopter/{adopters}',[
        'uses' => 'ProfileController@updateAdopter',
        'as' => 'adopter.updateprofile',
    ]);

});


Route::group(['middleware' => 'role:personnel'], function() {
       Route::get('personnelprofile', [
        'uses' => 'ProfileController@showPersonnel',
        'as' => 'personnel.profile',
     ]);

    Route::get('editpersonnel/{personnel}', [
        'uses' => 'ProfileController@editpersonnel',
        'as' => 'personnel.editprofile',
     ]);

      Route::post('updatepersonnel/{personnel}',[
        'uses' => 'ProfileController@updatepersonnel',
        'as' => 'personnel.updateprofile',
    ]);

});

Route::group(['middleware' => 'role:user'], function() {
       Route::get('userprofile', [
        'uses' => 'UserController@showUser',
        'as' => 'user.profile',
     ]);

      Route::get('edituser/{admin}', [
        'uses' => 'UserController@editUser',
        'as' => 'user.edit',
     ]);

      Route::post('updateuser/{admin}',[
        'uses' => 'UserController@updateuser',
        'as' => 'user.update',
    ]);

});


Route::post('search', [
         'uses' => 'SearchController@search',
         'as' => 'search',
     ]);

Route::get('animalshow/{id}', [
         'uses' => 'HomepageController@animalshow',
         'as' => 'homepage.animalshow',
     ]);

Route::post('postComment',[
    'uses'=> 'HomepageController@postComment', 
    'as' => 'animal.comment'
   ]);