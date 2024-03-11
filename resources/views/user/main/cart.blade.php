
@extends("user.layouts.master")
@section("title","Cart Page")
@section("content")

    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cartLists as $cartList)
                            <tr>
                                {{-- <input type="hidden" id="pizzaPrice" value={{$cartList->pizza_price}}> --}}
                                <td><img src="{{asset("storage/".$cartList->pizza_image)}}" class="img-thumbnail shadow-sm" style="width: 100px;"></td>
                                <td class="align-middle">{{$cartList->pizza_name}}
                                    <input type="hidden" id="orderId" value={{$cartList->id}}> 
                                    <input type="hidden" id="userId" value={{$cartList->user_id}}>
                                    <input type="hidden" id="productId" value="{{$cartList->product_id}}">
                                </td>
                                <td class="align-middle" id="pizzaPrice">{{$cartList->pizza_price}} Ks</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus" >
                                            <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        
                                        <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{$cartList->qty}}" id="qty">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle col-3" id="total">{{ $cartList->pizza_price * $cartList->qty }} Ks</td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove"><i class="fa fa-times"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotalPrice">{{$totalPrice}} Ks</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium">3000 Ks</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalPrice">{{$totalPrice + 3000}} Ks</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3 orderBtn" >Proceed To Checkout</button>
                        <button class="btn btn-block btn-danger font-weight-bold my-3 py-3 clearBtn" >Clear Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
    @endsection

    @section("scriptSource")
        <script src="{{asset("js/cart.js")}}"></script>
        <script>
            //order code
            $(".orderBtn").click(function(){
                $orderList = [];

                $randomNum = Math.floor(Math.random() * 1000000000001);
            $("#dataTable tbody tr").each(function(index,row){
                $orderList.push({
                    'user_id' : $(row).find("#userId").val(),
                    "product_id" : $(row).find("#productId").val(),
                    "qty" : $(row).find("#qty").val(),
                    "total" : $(row).find("#total").text().replace("Ks","") * 1,
                    "order_code" : "POS"+$randomNum
                });
            }) ;

            $.ajax({
                type : "get",
                url : "/user/ajax/order",
                data : Object.assign({}, $orderList),
                dataType : "json",
                success : function(response){
                    if(response.status)
                    {
                        window.location.href = "http://127.0.0.1:8000/user/homePage";
                    }
                }
              })
            })

            //remove all cart data
            $(".clearBtn").click(function(){
                $("#dataTable tbody tr").remove();
                $("#subTotalPrice").html("0 Ks");
                $("#finalPrice").html("3000 Ks");
                $.ajax({
                    type : "get",
                    url : "/user/ajax/clear/cart",
                    dataType : "json",
                })
            })

            //remove current product
            $(".btnRemove").click(function(){
                $parentNode = $(this).parents("tr");
                $productId = $parentNode.find("#productId").val();
                $orderId = $parentNode.find("#orderId").val();
                console.log($orderId);
                $.ajax({
                    type : "get",
                    url : "/user/ajax/clear/current/product",
                    dataType : "json",
                    data : {"productId" : $productId,"orderId" : $orderId},
                })
                $parentNode.remove();
                $totalPrice = 0;
                $("#dataTable tbody tr").each(function(index, row){//(index,row)
                    $totalPrice += Number($(row).find("#total").text().replace("Ks",""));
                });
                $("#subTotalPrice").html(`${$totalPrice} Ks`);
                $("#finalPrice").html(`${$totalPrice + 3000} Ks`);
            })
        </script>
    @endsection

    