<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //product list
    public function list()
    {
        $pizzas = Product::select("products.*","categories.name as category_name")
                    ->when(request("key"),function($query){
                    $query->where("products.name","like","%".request("key")."%");
                    })
                    ->leftJoin("categories","products.category_id","categories.id")
                    ->orderBy("products.created_at","desc")
                    ->paginate(3);
                    
        $pizzas->appends(request()->all());
        return view("admin.product.pizzaList",compact("pizzas"));
    }

    //direct create page link
    public function createPage()
    {
        $categories = Category::select("id","name")->get();
        return view("admin.product.create",compact("categories"));
    }

    //pizza create
    public function create(Request $request)
    {
        $this->productValidation($request,"create");
        $data = $this->getPizzaData($request);

        //image
        $fileName = uniqid().$request->file("pizzaImage")->getClientOriginalName();
        $request->file("pizzaImage")->storeAs("public",$fileName);
        $data["image"] = $fileName;

        Product::create($data);
        return redirect()->route("product#list")->with(["createSuccess"=>"Product Created!"]);
    }

    //pizza delete
    public function delete($id)
    {
        Product::where("id",$id)->delete();
        return back()->with(["deleteSuccess"=>"Product Deleted!"]);
    }

    //pizza edit
    public function edit($id)
    {
        $pizza=Product::select("products.*","categories.name as category_name")
                ->leftJoin("categories","products.category_id","categories.id")
                ->where("products.id",$id)->first();
        return view("admin.product.edit",compact("pizza"));
    }

    //pizza update
    public function updatePage($id)
    {
        $pizza=Product::where("id",$id)->first();
        $categories=Category::all();
        return view("admin.product.update",compact("pizza","categories"));
    }

    //pizza update
    public function update(Request $request)
    {
        $this->productValidation($request,"update");
        $updatePizza=$this->getPizzaData($request);
        if($request->hasFile("pizzaImage"))
        {
            $oldImage=Product::where("id",$request->pizzaId)->first()->image;
            if($oldImage != null)
            {
                Storage::delete("public/".$oldImage);
            }

            $fileName = uniqid().$request->file("pizzaImage")->getClientOriginalName();
            $request->file("pizzaImage")->storeAs("public",$fileName);
            $updatePizza["image"]=$fileName;
        }
        
        Product::where("id",$request->pizzaId)->update($updatePizza);
        return redirect()->route("product#list")->with(["updateSuccess"=>"Product Updated!"]);
    }

    //get pizza data
    protected function getPizzaData($request)
    {
        return [
            "category_id" => $request->pizzaCategory,
            "name" => $request->pizzaName,
            "description" => $request->pizzaDescription,
            "price" => $request->pizzaPrice,
            "waiting_time" => $request->pizzaWaitingTime
        ];
    }

    //product validation
    protected function productValidation($request,$action)
    {
        $validationRule = [
            "pizzaName"=>"required|min:5|unique:products,name,".$request->pizzaId,
            "pizzaCategory"=>"required",
            "pizzaDescription"=>"required|min:10",
            "pizzaPrice"=>"required",
            "pizzaWaitingTime"=>"required",
        ];

        $validationRule["pizzaImage"] = $action == "create" ?  "required|mimes:jpg,png,webp,jpeg|file" : "mimes:jpg,png,webp,jpeg|file";
        Validator::make($request->all(),$validationRule)->validate();
    }
}
