<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //change password page
    public function changePasswordPage()
    {
        return view("admin.account.changePassword");
    }

    //change password
    public function changePassword(Request $request)
    {
        /*
        1. all field need to fill
        2. new password & confirm password length must be greater than 6
        3. new password & confirm password must be same
        4. client old password must be same db password
        5. new password change in db
        */
        $this->passwordValidation($request);
        $currentId=Auth::user()->id;
        $oldDBPass=User::select("password")->where("id",$currentId)->first()->password;//retrieve old password
        if(Hash::check($request->oldPassword , $oldDBPass))
        {
            User::where("id",$currentId)->update([
                "password"=>Hash::make($request->newPassword),
            ]);
            // Auth::logout();
            // return redirect()->route("auth#loginPage");
            return back()->with(["changeSuccess"=>"Password Changed Success..."]);
        }
        return back()->with(["notMatch"=>"The Old Password not Match. Try Again!"]);
    }

    //direct detail -profile page
    public function detail()
    {
        return view("admin.account.detail");
    }

    //direct edit profile page
    public function edit()
    {
        return view("admin.account.edit");
    }

    //update profile page
    public function update($id,Request $request)
    {
        $this->accountValidation($request);
        $updateData = $this->getData($request);
        //for image
        if($request->hasFile("image"))
        {
            //old img, check->delete , store new img
            $oldImage=User::where("id",$id)->first()->image;
            
                Storage::delete("public/".$oldImage);
            // if($oldImage!=null)
            // {
            //     Storage::delete("public/".$oldImage);
            // }
            
            //storeImage
            $fileName = uniqid().$request->file("image")->getClientOriginalName();
            $request->file("image")->storeAs("public",$fileName);
            $updateData["image"] = $fileName;
        }
        
        User::where("id",$id)->update($updateData);
        return redirect()->route("admin#detail")->with(["updateSuccess"=>"Admin Account Updated..."]);
    }

    //admin list
    public function list()
    {
        $admins = User::when(request("key"),function($query){
                        $query->orWhere("name","like","%".request("key")."%")
                              ->orWhere("email","like","%".request("key")."%")
                              ->orWhere("gender","like","%".request("key")."%")
                              ->orWhere("phone","like","%".request("key")."%")
                              ->orWhere("address","like","%".request("key")."%");
                        })
                        ->where("role","admin")
                        ->orderBy("id","desc")
                        ->paginate(3);
        $admins->appends(request()->all());
        return view("admin.account.list",compact("admins"));
    }

    //admin delete
    public function delete($id)
    {
        User::where("id",$id)->delete();
        return back()->with(["deleteSuccess"=>"Admin Account Deleted..."]);
    }

    //change Role page
    public function changeRolePage($id){
        $user=User::where("id",$id)->first();
        return view("admin.account.changeRole",compact("user"));
    }

    //ajax change role
    public function changeRole(Request $request)
    {
        logger($request->all());
        User::where("id",$request->userId)->update([
            "role" => $request->status
        ]);
        return response()->json(200);
        // User::where("id",$request->userId)->update([
        //     "status" => $request->status,
        // ]);
        // return response()->json(200); 
    }

    //request update data
    protected function getData($request)
    {
        return [
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "gender" => $request->gender,
            "address" => $request->address,
            "updated_at" => Carbon::now(),
        ];
    }

    //account validation
    protected function accountValidation($request)
    {
        Validator::make($request->all(),[
            "name"=>"required",
            "email"=>"required",
            "phone"=>"required",
            "gender"=>"required",
            "address"=>"required",
            "image"=>"mimes:jpg,png,webp,jpeg",
        ])->validate();
    }

    //password validation
    protected function passwordValidation($request)
    {
        Validator::make($request->all(),[
            "oldPassword"=>"required|min:6|max:10",
            "newPassword"=>"required|min:6|max:10",
            "confirmPassword"=>"required|min:6|max:10|same:newPassword",
        ])->validate();
    }
}
