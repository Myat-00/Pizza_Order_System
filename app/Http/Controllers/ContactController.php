<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //direct contact list page
    public function contactList()
    {
        $contacts = Contact::when(request("key"),function($query){
                            $query->orWhere("name","like","%".request("key")."%")
                                  ->orWhere("email","like","%".request("key")."%");
                            })
                            ->orderBy("created_at","desc")
                            ->paginate(4);
        $contacts->appends(request()->all());
        return view("admin.contact.list",compact("contacts"));
    }

    //delete contact list
    public function deleteContactList($id)
    {
        Contact::where("id",$id)->delete();
        return back()->with(["deleteSuccess"=> "Contact Deleted!"]);
    }

    //direct contact page
    public function contactPage()
    {
        return view("user.contact.home");
    }

    //send message
    public function sendMessage(Request $request)
    {
        $this->contactValidation($request);
        Contact::create([
            "name" => Auth::user()->name,
            "email" => Auth::user()->email,
            "message" => $request->message,
            "created_at" => Carbon::now()
        ]);
        return redirect()->route("user#home");
    }

    //contact validation
    protected function contactValidation($request)
    {
        Validator::make($request->all(),[
            "message" => "required"
        ])->validate();
    }
}
