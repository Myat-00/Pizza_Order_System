@extends("admin.layouts.master")
@section("title","Admin List Page")
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
                                <h2 class="title-1">Admin List</h2>

                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-3">
                            <h4 class="text-secondary">Search Key : <span class="text-danger">{{request("key")}}</span></h4>
                        </div>
                        <div class="col-3">
                            <div class="text-center" data-toggle="tooltip" title="Total">
                                <h3><i class="fa-solid fa-database me-2">({{$admins->total()}})</i> </h3>
                            </div>
                        </div>
                        <div class="col-3 offset-3">
                            <form action="{{route("admin#list")}}" method="get">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="key" class="form-control" value="{{request("key")}}" placeholder="Search...">
                                <button class="btn btn-dark"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if (session("deleteSuccess"))
                        <div class="col-4 offset-8 alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><i class="fa-solid fa-circle-xmark me-2"></i>{{session("deleteSuccess")}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($admins->count())
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>                            
                            <tbody>
                                @foreach ($admins as $admin)
                                <tr class="shadow">
                                    
                                    <td class="col-2">
                                        <input type="hidden" id="userId" value="{{$admin->id}}">
                                        @if($admin->image == null)
                                            @if($admin->gender == "male")
                                            <img src="{{asset("images/default_user.png")}}" class="img-thumbnail shadow-sm w-100" style="height:130px">
                                            @else
                                            <img src="{{asset("images/default_female_user.webp")}}" class="img-thumbnail shadow-sm w-100" style="height:130px">
                                            @endif
                                        @else
                                            <img src="{{asset("storage/".$admin->image)}}" class="img-thumbnail shadow-sm w-100" style="height:130px">
                                        @endif
                                    </td>
                                    <td class="col-2">{{$admin->name}}</td>
                                    <td>{{$admin->email}}</td>
                                    <td>{{$admin->gender}}</td>
                                    <td>{{$admin->phone}}</td>
                                    <td>{{$admin->address}}</td>
                                    <td class="col-2">
                                        @if(Auth::user()->id == $admin->id)
                                        @else
                                            <select class="form-control changeRole">
                                                <option value="admin" @if($admin->role == "admin") selected @endif>Admin</option>
                                                <option value="user" @if($admin->role == "user") selected @endif>User</option>
                                            </select>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="table-data-feature">
                                            @if(Auth::user()->id == $admin->id)
                                            @else
                                                <a href="{{route("admin#delete",$admin->id)}}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach                                                            
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{$admins->links()}}
                            {{-- {{$categories->appends(request()->query())->links()}} --}}
                        </div>
                    </div>
                    @else
                        <h3 class="text-center mt-5 text-secondary">There is no Admin Here!</h3>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
@section("scriptSection")
    <script>
        $(document).ready(function(){
            $(".changeRole").change(function(){
                $currentStatus = $(this).val();
                $parentNode = $(this).parents("tr");
                $userId = $parentNode.find("#userId").val();
                $data = {
                    "status" : $currentStatus,
                    "userId" : $userId
                };
                $.ajax({
                    type : "get",
                    url : "/admin/ajax/change/role",
                    data : $data,
                    dataType : "json",
                })
                location.reload();
            })
        })
    </script>
@endsection