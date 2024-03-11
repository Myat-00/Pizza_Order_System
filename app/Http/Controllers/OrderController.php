<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //direct order page
    public function orderList()
    {
        $orders= Order::select("orders.*","users.name as user_name")
                    ->leftJoin("users","orders.user_id","users.id")
                    ->orderBy("orders.created_at","desc")
                    ->paginate(5); 
        $orders->appends(request()->all());
        return view("admin.order.list",compact("orders"));
    }

    //order list
    public function listInfo($orderCode)
    {
        $order = Order::where("order_code",$orderCode)->first();
        $orderLists = OrderList::select("order_lists.*","users.name as user_name","products.name as product_name","products.image as product_image")
                        ->leftJoin("users","order_lists.user_id","users.id")
                        ->leftJoin("products","order_lists.product_id","products.id")
                        ->where("order_code",$orderCode)
                        ->get();
        return view("admin.order.productList",compact("orderLists","order"));

    }

    //sort with ajax
    public function ajaxStatus(Request $request)
    {
        $order = Order::select("orders.*","users.name as user_name")
                    ->leftJoin("users","orders.user_id","users.id")
                    ->orderBy("orders.created_at","desc");
        if($request->status == null)
        {
            $order = $order->get();
        }else{
            $order = $order->where("orders.status",$request->status)->get();
        }
        return response()->json($order,200);

    }

    //ajax change status
    public function ajaxChangeStatus(Request $request)
    {
        // logger($request->all());
        Order::where("id",$request->orderId)->update([
            "status" => $request->status
        ]);
        $orders= Order::select("orders.*","users.name as user_name")
                    ->leftJoin("users","orders.user_id","users.id")
                    ->orderBy("orders.created_at","desc")
                    ->get();
        return response()->json($order,200);
    }
}
