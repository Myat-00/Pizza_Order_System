<?php

namespace App\Http\Controllers\User;

use Storage;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //direct user list page
    public function userList()
    {
        $users = User::when(request("key"),function($query,$search){
                        $query->orWhere("name","like","%".$search."%")
                              ->orWhere("email","like","%".$search."%")
                              ->orWhere("gender","like","%".$search."%")
                              ->orWhere("phone","like","%".$search."%")  
                              ->orWhere("address","like","%".$search."%");
                        })
                        ->orderBy("created_at","desc")
                        ->where("role","user")
                        ->paginate(3);
        $users->appends(request()->all());
        return view("admin.user.list",compact("users"));
    }

    //user list update page
    public function userListUpdatePage($id)
    {
        $user = User::where("id",$id)->first();
        return view("admin.user.update",compact("user"));
    }

    //update user list
    public function updateUserList(Request $request)
    {
        // dd($request->all());
        $this->accountValidation($request);
        $updateUserList = $this->getUpdateUserList($request);
        if($request->hasFile("image"))
        {
            $oldImage = User::where("id",$request->userId)->first()->image;
            if($oldImage != null)
            {
                Storage::delete("public/".$oldImage);
            }
            $fileName = uniqid().$request->file("image")->getClientOriginalName();
            $request->file("image")->storeAs("public",$fileName);
            $updateUserList["image"]=$fileName;
        }
        User::where("id",$request->userId)->update($updateUserList);
        return redirect()->route("admin#userList");
    }

    //get update user list
    protected function getUpdateUserList($request)
    {
        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'gender'=>$request->gender,
            "role"=>$request->role
        ];
    }

    //delete user list
    public function deleteUserList($id)
    {
        User::where("id",$id)->delete();
        return back()->with(["deleteSuccess"=>"User Deleted!"]);
    }

    //user change role
    public function userChangeRole(Request $request)
    {
        User::where("id",$request->userId)->update([
            "role" => $request->role,
        ]);
    }
    
    //direct home page
    public function home()
    {
        $pizzas = Product::orderBy("created_at","desc")->get();
        $categories = Category::all();
        $cart = Cart::where("user_id",Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        // $pizzas->appends(request()->all());
        return view("user.main.home",compact("pizzas","categories","cart","history"));
    }

    //filter category
    public function filter($categoryId)
    {
        $pizzas = Product::where("category_id",$categoryId)->orderBy("created_at","desc")->get();
        $categories = Category::all();
        $cart = Cart::where("user_id",Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view("user.main.home",compact("pizzas","categories","cart","history"));
    }

    //direct history page
    public function history()
    {
        $orders = Order::orderBy("created_at","desc")->where('user_id',Auth::user()->id)->paginate(5);
        $orders->appends(request()->all());
        return view("user.main.history",compact("orders"));
    }

    //direct pizza detail page
    public function details($pizzaId)
    {
        $pizza = Product::where("id",$pizzaId)->first();
        $pizzaLists = Product::all();
        return view("user.main.details",compact("pizza","pizzaLists"));
    }

    //cart list
    public function cartList()
    {
        $cartLists = Cart::select("carts.*","products.name as pizza_name","products.price as pizza_price","products.image as pizza_image")
                    ->leftJoin("products","carts.product_id","products.id")
                    ->where("carts.user_id",Auth::user()->id)
                    ->get();
        $totalPrice = 0;
        foreach($cartLists as $cart)
        {
            $totalPrice += $cart->pizza_price * $cart->qty;
        }
        return view("user.main.cart",compact("cartLists","totalPrice"));
    }

    //direct change password page
    public function changePasswordPage()
    {
        return view("user.password.change");
    }

    //change password
    public function changePassword(Request $request)
    {
        $this->passwordValidation($request);
        $currentId = Auth::user()->id;
        $oldPass = User::where("id",$currentId)->first()->password;
        if(Hash::check($request->oldPassword,$oldPass))
        {
            User::where("id",$currentId)->update([
                'password' => Hash::make($request->newPassword),
            ]);
            return back()->with(["changeSuccess"=>"Password Changed..."]);
        }
        return back()->with(["notMatch"=>"The old password is not the same. Try Again..."]);
    }

    //user accouont change page
    public function accountChangePage()
    {
        return view("user.profile.account");
    }

    //user account change
    public function accountChange($id,Request $request)
    {
        $this->accountValidation($request);
        $updateDatas = $this->getUpdateData($request);
        if($request->hasFile('image'))
        {
            $oldImage = User::where("id",$id)->first()->image;
            if($oldImage != null)
            {
                Storage::delete("public/".$oldImage);
            }
            $fileName = uniqid().$request->file("image")->getClientOriginalName();
            $request->file("image")->storeAs("public",$fileName);
            $updateDatas["image"] = $fileName;
        }
        User::where("id",$id)->update($updateDatas);
        return back()->with(["updateSuccess"=>"Account Updated..."]);
    }

    //account validation
    protected function accountValidation($request)
    {
        Validator::make($request->all(),[
            "name" => "required",
            "email" => "required",
            "phone" => "required",
            "gender" => "required",
            "address" => "required",
            "image" => "mimes:jpg,png,jpeg,webp",
        ])->validate();
    }

    //get update data
    public function getUpdateData($request)
    {
        return [
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "gender" => $request->gender,
            "address" => $request->address,
        ];
    }

    //password validation
    protected function passwordValidation($request)
    {
        Validator::make($request->all(),[
            "oldPassword" => "required|min:5|max:20",
            "newPassword"=> "required|min:5|max:20",
            "confirmPassword" => "required|min:5|max:20|same:newPassword"
        ])->validate();
    }
}
