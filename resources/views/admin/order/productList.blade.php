@extends("admin.layouts.master")
@section("title","Order Detail List Page")
@section("content")
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        {{-- <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Order Detail List</h2>

                            </div>
                        </div> --}}
                        <div class="">
                            <i class="fa-solid fa-arrow-left fs-5" onclick="history.back()"></i>
                        </div>
                    </div>

                    {{-- <div class="row mb-3">
                        <div class="col-3">
                            <h4 class="text-secondary">Search Key : <span class="text-danger">{{request("key")}}</span></h4>
                        </div>
                        <div class="col-3">
                            <div class="text-center" data-toggle="tooltip" title="Total">
                                <h3><i class="fa-solid fa-database"></i> ({{count($orders)}})</h3>
                            </div>
                        </div>
                        <div class="col-3 offset-3">
                            <form action="" method="get">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="key" class="form-control" value="{{request("key")}}" placeholder="Search...">
                                <button class="btn btn-dark"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>
                    </div> --}}

                     {{-- @if (session("createSuccess"))
                        <div class="col-4 offset-8 alert alert-success alert-dismissible fade show" role="alert">
                            <strong><i class="fa-solid fa-check me-2"></i>{{session("createSuccess")}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session("deleteSuccess"))
                        <div class="col-4 offset-8 alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><i class="fa-solid fa-circle-xmark me-2"></i>{{session("deleteSuccess")}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session("updateSuccess"))
                        <div class="col-4 offset-8 alert alert-warning alert-dismissible fade show" role="alert">
                            <strong><i class="fa-solid fa-check me-2"></i>{{session("updateSuccess")}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif --}}
                    
                    {{-- <div class="my-3 d-flex">
                        <label for="form-label" class="me-3 mt-1">Order Status</label>
                        <select id="orderStatus" class="form-control col-2">
                            <option value="">All</option>
                            <option value="0">Pending</option>
                            <option value="1">Accept</option>
                            <option value="2">Reject</option>
                        </select>
                    </div> --}}

                    <div class="row">
                        <div class="col-5">
                            <div class="card">
                                <div class="card-body" style="border-bottom: 1px solid black">
                                    <h3 class="mb-2"><i class="fa-solid fa-clipboard-list me-2"></i>Order Info</h3>
                                    <small class="text-warning"><i class="fa-solid fa-triangle-exclamation me-2"></i>Include Delivery Charges...</small>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col"><i class="fa-solid fa-user me-2"></i>Customer Name</div>
                                        <div class="col">{{strtoupper($orderLists[0]->user_name)}}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col"><i class="fa-solid fa-barcode me-2"></i>Order Code</div>
                                        <div class="col">{{$orderLists[0]->order_code}}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col"><i class="fa-regular fa-calendar-check me-2"></i>Order Date</div>
                                        <div class="col">{{$orderLists[0]->created_at->format("F-j-Y")}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col"><i class="fa-solid fa-money-bill-wave me-2"></i>Total Price</div>
                                        <div class="col">{{$order->total_price}} Ks</div>
                                    </div>
                                    {{-- <div class="row">
                                        <div class="col"></div>
                                        <div class="col"><span class="text-danger">(Included delivery cost...)</span></div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Order ID</th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                    <th>Order Date</th>
                                </tr>
                            </thead> 
                            {{-- {{$orderList->product_name}}  
                            {{$orderList->created_at->formate("F-j-Y")}}                          --}}
                            <tbody id="dataList">
                                @foreach ($orderLists as $orderList)
                                <tr class="shadow">
                                    <td></td>
                                    <td>{{$orderList->id}}</td>
                                    <td class="col-2">
                                        <img src="{{asset("storage/".$orderList->product_image)}}" class="img-thumbnail shadow-sm" >
                                    </td>
                                    <td>{{$orderList->product_name}} </td>
                                    <td>{{$orderList->qty}}</td>
                                    <td>{{$orderList->total}} Ks</td>
                                    <td>{{$orderList->created_at->format("F-j-Y")}}</td>
                                    {{-- <td class="col-2">
                                        <a href="{{route("admin#listInfo",$order->order_code)}}">
                                            {{$order->order_code}}
                                        </a>
                                    </td>
                                    <td class="col-2">{{$order->total_price}} Ks</td>
                                    <td class="col-2">
                                        <select name="status" class="form-control statusChange">
                                            <option value="0" @if($order->status == 0) selected @endif>Pending</option>
                                            <option value="1" @if($order->status == 1) selected @endif>Accept</option>
                                            <option value="2" @if($order->status == 2) selected @endif>Reject</option>
                                        </select>
                                    </td> --}}
                                </tr>
                                @endforeach                                                            
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{-- {{$orders->links()}} --}}
                            {{-- {{$categories->appends(request()->query())->links()}} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

