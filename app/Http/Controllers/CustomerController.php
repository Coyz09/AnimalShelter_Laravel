<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Redirect;
use Validator;
use App\Models\Customer;

class CustomerController extends Controller
{
     public function index()
	    {
		     $customers = Customer::orderBy('id','ASC')->get();
		      // dd($customers);
		     return View::make('customer.index',compact('customers'));
		    
	    }

	     public function destroy($id)
		    {
		         $customer = Customer::find($id);
		         $customer->delete();
		         return Redirect::to('customer')->with('success','Customer deleted!');
		    }
}
