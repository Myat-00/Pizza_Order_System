@extends("admin.layouts.master")
@section("title","Order List Page")
@section("content")
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Order List</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <h3>Total - {{$orders->total()}}</h3>
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

                     @if (session("createSuccess"))
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
                    @endif

                    <div class="d-flex my-4">
                        <label for="form-label" class="me-3 mt-1">Order Status</label>
                        <select id="orderStatus" class="form-control col-2">
                            <option value="">All</option>
                            <option value="0">Pending</option>
                            <option value="1">Accept</option>
                            <option value="2">Reject</option>
                        </select>
                        {{-- <button class="btn btn-dark searchStatus"><i class="fa-solid fa-magnifying-glass"></i></button> --}}
                    </div>

                    @if ($orders->count())
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>Order Date</th>
                                    <th>Order Code</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>                            
                            <tbody id="dataList">
                                @foreach ($orders as $order)
                                <tr class="shadow">
                                    <input type="hidden" class="orderId" value="{{$order->id}}">
                                    <td class="col-2">{{$order->user_id}}</td>
                                    <td class="col-2">{{$order->user_name}}</td>
                                    <td class="col-2">{{$order->created_at->format("F-j-Y")}}</td>
                                    <td class="col-2">
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
                                    </td>
                                </tr>
                                @endforeach                                                            
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{$orders->links()}}
                            {{-- {{$categories->appends(request()->query())->links()}} --}}
                        </div>
                    </div>
                    @else
                        <h3 class="text-secondary text-center mt-5">There is no Order Here!</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

@section("scriptSection")
<script>
    $(document).ready(function(){
        $("#orderStatus").change(function(){
            $status = $("#orderStatus").val();
            $.ajax({
                type : "get",
                url : "http://127.0.0.1:8000/order/ajax/status",
                dataType : "json",
                data : {
                    "status" : $status,
                },
                success : function(response){
                    $list = "";
                    for($i=0;$i<response.length;$i++)
                    {
                        $months = ["January","Feburary","March","April","May","June","July","August","September","October","November","December"];
                        $dbDate = new Date(response[$i].created_at);
                        $finalDate = $months[$dbDate.getMonth()]+"_"+$dbDate.getDate()+"_"+$dbDate.getFullYear();

                        if(response[$i].status == 0)
                        {
                            $statusMessage = `
                                    <select name="status" class="form-control statusChange">
                                        <option value="0" selected>Pending</option>
                                        <option value="1" >Accept</option>
                                        <option value="2" >Reject</option>
                                    </select>`;
                        }else if(response[$i].status == 1)
                        {
                            $statusMessage = `
                                    <select name="status" class="form-control statusChange">
                                        <option value="0">Pending</option>
                                        <option value="1" selected>Accept</option>
                                        <option value="2" >Reject</option>
                                    </select>`;
                        }else if(response[$i].status == 2)
                        {
                            $statusMessage = `
                                    <select name="status" class="form-control statusChange">
                                        <option value="0">Pending</option>
                                        <option value="1" >Accept</option>
                                        <option value="2" selected>Reject</option>
                                    </select>`;
                        }

                        $list += `
                                <tr class="shadow">
                                    <input type="hidden" class="orderId" value="${response[$i].id}">
                                    <td class="col-2">${response[$i].user_id}</td>
                                    <td class="col-2">${response[$i].user_name}</td>
                                    <td class="col-2">${$finalDate}</td>
                                    <td class="col-2">${response[$i].order_code}</td>
                                    <td class="col-2">${response[$i].total_price} Ks</td>
                                    <td class="col-2">
                                        ${$statusMessage}
                                    </td>
                                </tr>`;
                    }
                    $("#dataList").html($list);
                }
            })
        })

        //change status
        $(".statusChange").change(function(){
            console.log("change event");
            $currentStatus = $(this).val();
            $parendNode = $(this).parents("tr");
            $orderId = $parendNode.find(".orderId").val();
            $data = {
                "orderId" : $orderId,
                "status" : $currentStatus,
            };
            console.log($data);
            $.ajax({
                type : "get",
                url : "http://127.0.0.1:8000/order/ajax/change/status",
                dataType : "json",
                data : $data,
            })
            
        })


        // $(".searchStatus").click(function(){
        //     $currentStatus = "";
        //     $("#orderStatus").change(function(){
        //         $currentStatus = $("#orderStatus").val();
                
        //     })
        //     console.log($currentStatus);
        // })
    })
</script>
@endsection