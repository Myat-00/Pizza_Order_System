@extends("admin.layouts.master")
@section("title","Product List Page")
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
                                <h2 class="title-1">Product List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{route("product#createPage")}}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="fa-solid fa-plus"></i>Add Product
                                </button>  
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>  
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-3">
                            <h4 class="text-secondary">Search Key : <span class="text-danger">{{request("key")}}</span></h4>
                        </div>
                        <div class="col-3">
                            <div class="text-center" data-toggle="tooltip" title="Total">
                                <h3><i class="fa-solid fa-database"></i> ({{$pizzas->total()}})</h3>
                            </div>
                        </div>
                        <div class="col-3 offset-3">
                            <form action="{{route("product#list")}}" method="get">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="key" class="form-control" value="{{request("key")}}" placeholder="Search...">
                                <button class="btn btn-dark"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>

                     @if (session("createSuccess"))
                        <div class="col-4 offset-8 alert alert-success alert-dismissible fade show" role="alert">
                            <strong><i class="fa-solid fa-circle-check me-2"></i>{{session("createSuccess")}}</strong>
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
                        <div class="col-4 offset-8 alert alert-primary alert-dismissible fade show" role="alert">
                            <strong><i class="fa-solid fa-check me-2"></i>{{session("updateSuccess")}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    @if ($pizzas->count())
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>View Count</th>
                                    <th></th>
                                </tr>
                            </thead>                            
                            <tbody>
                                @foreach ($pizzas as $pizza)
                                <tr class="shadow">
                                    <td class="col-2">
                                        <img src="{{asset("storage/".$pizza->image)}}" class="img-thumbnail shadow-sm w-100" style="height: 150px">
                                    </td>
                                    <td class="col-2">{{$pizza->name}}</td>
                                    <td class="col-2">{{$pizza->price}} Ks</td>
                                    <td class="col-2">{{$pizza->category_name}}</td>
                                    <td class="col-2"><i class="fa-solid fa-eye mr-1"></i>{{$pizza->view_count}}</td>
                                    <td class="col-2">
                                        <div class="table-data-feature">
                                            <a href="{{route("product#edit",$pizza->id)}}" class="me-1">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                            </a>
                                            <a href="{{route("product#updatePage",$pizza->id)}}" class="me-1">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                            </a>
                                            <a href="{{route("product#delete",$pizza->id)}}">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach                                                            
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{$pizzas->links()}}
                            {{-- {{$categories->appends(request()->query())->links()}} --}}
                        </div>
                    </div>
                    @else
                        <h3 class="text-secondary text-center mt-5">There is no Product Here!</h3>
                    @endif
                    
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection