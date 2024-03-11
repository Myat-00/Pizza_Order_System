@extends("admin.layouts.master")
@section("title","User List Page")
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
                                <h2 class="title-1">User List</h2>

                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-3">
                            <h4 class="text-secondary">Search Key : <span class="text-danger">{{request("key")}}</span></h4>
                        </div>
                        <div class="col-3">
                            <div class="text-center" data-toggle="tooltip" title="Total">
                                <h3><i class="fa-solid fa-database"></i> ({{$users->total()}})</h3>
                            </div>
                        </div>
                        <div class="col-3 offset-3">
                            <form action="{{route("admin#userList")}}" method="get">
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

                    @if ($users->count())
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
                                    <th>Role</th>
                                    <th></th>
                                </tr>
                            </thead>                            
                            <tbody id="dataList">
                                @foreach ($users as $user)
                                <tr class="shadow">
                                    <input type="hidden" id="userId" value="{{$user->id}}">
                                    <td class="col-2">
                                        @if($user->image == null)
                                            @if($user->gender == "male")
                                            <img src="{{asset("images/default_user.png")}}" class="img-thumbnail shadow-sm w-100" style="height:130px">
                                            @else
                                            <img src="{{asset("images/default_female_user.webp")}}" class="img-thumbnail shadow-sm w-100" style="height:130px">
                                            @endif
                                        @else
                                            <img src="{{asset("storage/".$user->image)}}" class="img-thumbnail shadow-sm w-100" style="height:130px">
                                        @endif
                                    </td>
                                    <td class="col-2">{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->gender}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>{{$user->address}}</td>
                                    <td class="col-2">
                                        <select class="form-control changeRole">
                                            <option value="admin" @if($user->role=="admin") selected @endif>Admin</option>
                                            <option value="user" @if($user->role=="user") selected @endif>User</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="table-data-feature">
                                            <a href="{{route("admin#userListUpdatePage",$user->id)}}" class="me-1">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                            </a>
                                            <a href="{{route("admin#deleteUserList",$user->id)}}">
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
                            {{$users->links()}}
                            {{-- {{$categories->appends(request()->query())->links()}} --}}
                        </div>
                    </div>
                    @else
                        <h3 class="text-secondary text-center mt-5">There is no User Here!</h3>
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
            $(".changeRole").change(function(){
                $currentRole = $(this).val();
                $parentNode = $(this).parents("tr");
                $userId = $parentNode.find("#userId").val();
                $data = {
                    "role" : $currentRole,
                    "userId" : $userId
                };
                $.ajax({
                    type : "get",
                    url : "/user/change/role",
                    dataType : "json",
                    data : $data
                })
                location.reload();
            })
        })
    </script>
@endsection
