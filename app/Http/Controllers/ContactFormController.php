<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormEmail;
use App\Models\Customer;

class ContactFormController extends Controller
{

    public function create(){
        return view('contact.create');
    }

    public function store(Request $request){
        $data = request()->validate([
            'customer_Name' => 'required',
            'customer_Email' => 'required|email',
            'customer_Message' => 'required',
        ]);

            $mails = $request->all();
            Customer::create($request->all());
            Mail::to('admin@animalshelter.com')->send(new ContactFormEmail($data));
            return redirect('contact')
            ->with('success','Email Successfully Sent.');
        
    }
}
