@extends("admin.layouts.master")
@section("title","Contact List Page")
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
                                <h2 class="title-1">Contact List</h2>

                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-4">
                            <h4 class="text-secondary">Search Key : <span class="text-danger">{{request("key")}}</span></h4>
                        </div>
                        <div class="col-3">
                            <div class="text-center" data-toggle="tooltip" title="Total">
                                <h3><i class="fa-solid fa-database"></i> ({{$contacts->count()}})</h3>
                            </div>
                        </div>
                        <div class="col-3 offset-2">
                            <form action="{{route("admin#contactList")}}" method="get">
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

                    @if ($contacts->count())
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th></th>                                    
                                </tr>
                            </thead>                            
                            <tbody id="dataList">
                                @foreach ($contacts as $contact)
                                <tr class="shadow">
                                    <td></td>
                                    <td class="col-2">{{$contact->name}}</td>
                                    <td>{{$contact->email}}</td>
                                    <td>{{$contact->message}}</td>
                                    <td>
                                        <div class="table-data-feature">
                                            <a href="{{route("admin#deleteContactList",$contact->id)}}">
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
                            {{$contacts->links()}}
                            {{-- {{$categories->appends(request()->query())->links()}} --}}
                        </div>
                    </div>
                    @else
                        <h3 class="text-secondary text-center mt-5">There is no Contact Here!</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

{{-- @section("scriptSection")
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
                    url : "http://127.0.0.1:8000/user/change/role",
                    dataType : "json",
                    data : $data
                })
                location.reload();
            })
        })
    </script>
@endsection --}}
