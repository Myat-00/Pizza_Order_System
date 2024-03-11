<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    //get all category list
    public function categoryList()
    {
        $categories = Category::orderBy("id","desc")->get();
        return response()->json($categories, 200);
    }

    //get all product list
    public function productList()
    {
        $products=Product::get();
        return response()->json($products, 200);
    }

    //get all admin list
    public function adminList()
    {
        $admins=User::where("role","admin")->get();
        return response()->json($admins, 200);
    }

    //get all user list
    public function customerList()
    {
        $customers=User::where("role","user")->get();
        return response()->json($customers, 200);
    }

    //get all order list
    public function orderList()
    {
        $orders=OrderList::get();
        return response()->json($orders, 200);

    }

    //get all contact list
    public function contactList()
    {
        $contacts=Contact::orderBy("id","desc")->get();
        return response()->json($contacts, 200);
    }

    //get all user list
    public function userList()
    {
        $users=User::get();
        return response()->json($users, 200);
    }

    //get all
    public function orderSystem()
    {
        $products=Product::get();
        $categories=Category::get();
        $admins=User::where("role","admin")->get();
        $users=User::where("role","user")->get();
        $orders=OrderList::get();
        $contacts=Contact::get();
        $data=[
            "category"=>$categories,
            "product"=>$products,
            "people"=>[
                "admin"=>$admins,
                "user"=>$users
            ],
            "order"=>$orders,
            "contact"=>$contacts
        ];
        return response()->json($data, 200);
    }
    
    //create category
    public function createCategory(Request $request)
    {
        //$request->header();
        $data = [
            "name"=>$request->name,
            "created_at"=>Carbon::now(),
            "updated_at"=>Carbon::now(),
        ];
        $response = Category::create($data);
        return response()->json($response,200);
    }

    //create contact
    public function createContact(Request $request)
    {
        $data = [
            "name" => $request->name,
            "email" => $request->email,
            "message" => $request->message
        ];
        Contact::create($data);
        $response = Contact::orderBy("id","desc")->get();
        return response()->json($response,200);
    }

    //create customer
    public function createCustomer(Request $request)
    {
        $data = [
            "name"=>$request->name,
            "email"=>$request->email,
            "phone"=>$request->phone,
            "gender"=>$request->gender,
            "address"=>$request->address,
            "role"=>$request->role,
            "password"=>bcrypt($request->password),
        ];
        User::create($data);
        return response()->json(["message"=>"create Success"],200);
        // $response = User::orderBy("created_at","desc")->get();
        // return response()->json($response,200);
    }

    //delete category
    public function deleteCategory(Request $request)
    {
        $data = Category::where("id",$request->id)->first();
        if(isset($data))
        {
            Category::where("id",$request->id)->delete();
            return response()->json(["status"=>true,"message"=>"delete success"],200);
        }
        return response()->json(["status"=>false,"message"=>"there is no category"]);
    }

    //delete category
    public function deleteContact($id)
    {
        $data = Contact::where("id",$id)->first();
        if(isset($data))
        {
            Contact::where("id",$id)->delete();
            return response()->json(["status"=>true,"message"=>"delete success"],200);
        }
        return response()->json(["status"=>false,"message"=>"there is  no contact"],500);
    }

    //details category
    public function detailCategory($id)
    {
        $data = Category::where("id",$id)->first();
        if(isset($data))
        {
            return response()->json(["status"=>true,"category"=>$data],200);
        }
        return response()->json(["status"=>false,"category"=>"there is no category"],500);
    }

    //update category
    public function updateCategory(Request $request)
    {
        $categoryId = $request->category_id;
        $data = Category::where("id",$categoryId)->first();
        if(isset($data))
        {
            Category::where("id",$categoryId)->update([
                "name"=>$request->name,
                "created_at"=>Carbon::now(),
                "updated_at"=>Carbon::now()
            ]);
            $response = Category::where("id",$categoryId)->first();
            return response()->json(["status"=>true,"message"=>"Update Success","category"=>$response],200);
        }
        return response()->json(["status"=>false,"message"=>"there is no category..."],500);
    }

    //delete customer
    public function deleteCustomer($id)
    {
        $customer = User::where("id",$id)->first();
        if(isset($customer))
        {
            User::where("id",$id)->delete();
            return response()->json(["status"=>true,"message"=>"delete success","customer"=>$customer],200);
        }
        return response()->json(["status"=>false,"message"=>"there is no customer..."],500);
    }

    //update customer
    public function updateCustomer(Request $request)
    {
        $currentId = $request->id;
        $data = User::where("id",$currentId)->first();
        if(isset($data))
        {
            User::where("id",$currentId)->update([
                "name" => $request->name,
            ]);
            $response = User::orderBy("id","desc")->get();
            return response()->json(["status"=>true,"message"=>"update success","customer"=>$response],200);
        }
        return response()->json(["status"=>false,"message"=>"there is no customer..."],500);
    }

    //detail customer
    public function detailCustomer(Request $request)
    {
        $id = $request->id;
        $data = User::where("id",$id)->first();
        if(isset($data))
        {
            return response()->json($data,200);
        }
        return response()->json(["message"=>"thers is no customer"],500);
    }

    //detail contact
    public function detailContact($name)
    {
        $data = Contact::where('name',$name)->first();
        if(isset($data))
        {
            return response()->json($data,200);
        }
        return response()->json(["message"=>"there is no contact"],500);
    }
}
