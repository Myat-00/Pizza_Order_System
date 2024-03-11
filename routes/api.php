<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//get all
Route::get("category/list",[RouteController::class,"categoryList"]);
Route::get("product/list",[RouteController::class,"productList"]);
Route::get("admin/list",[RouteController::class,"adminList"]);
Route::get("customer/list",[RouteController::class,"customerList"]);
Route::get("order/list",[RouteController::class,"orderList"]);
Route::get("contact/list",[RouteController::class,"contactList"]);
Route::get("user/list",[RouteController::class,"userList"]);
Route::get("order/system",[RouteController::class,"orderSystem"]);

//create
Route::post("create/category",[RouteController::class,"createCategory"]);
Route::post("create/contact",[RouteController::class,"createContact"]);
Route::post("create/customer",[RouteController::class,"createCustomer"]);

//delete
Route::post("delete/category",[RouteController::class,"deleteCategory"]);
Route::get("delete/contact/{id}",[RouteController::class,"deleteContact"]);//post & get
Route::get("delete/customer/{id}",[RouteController::class,"deleteCustomer"]);

//update
Route::post("category/update",[RouteController::class,"updateCategory"]);
Route::post("update/customer",[RouteController::class,"updateCustomer"]);

//details
Route::get("category/details/{id}",[RouteController::class,"detailCategory"]);
Route::post("customer/details",[RouteController::class,"detailCustomer"]);
Route::get("contact/details/{name}",[RouteController::class,"detailContact"]);
//POST
// Route::post("create/category",[RouteController::class,"createCategory"]);
// 
// 

// Route::get("category/details/{id}",[RouteController::class,"detailCategory"]);//post & get
// 

/**
*  //category list
*  127.0.0.1:8000/api/category/list (GET)
*
*  //create category
*  127.0.0.1:8000/api/create/category (POST)
*
*
*
* 
*/