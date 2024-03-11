@extends("admin.layouts.master")
@section("title","Pizza Edit Page")
@section("content")
    <!-- MAIN CONTENT-->
    <div class="main-content">
        {{-- <div class="row">
            <div class="col-4 offset-6 mb-2">
            </div>
        </div> --}}
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1 ">
                    <div class="card">
                        <div class="card-body">
                            <div class="ms-5">
                                <i class="fa-solid fa-arrow-left fs-5" onclick="history.back()"></i>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-3 offset-1">
                                    <img src="{{asset("storage/".$pizza->image)}}" class="img-thumbnail " style="height:230px"/>
                                </div>
                                <div class="col-8">
                                        <h2 class="text-danger">{{$pizza->name}}</h2>
                                        <span class="my-3 btn btn-dark" data-toggle="tooltip" title="Price" data-placement="bottom"><i class="fa-solid fa-money-bill me-2 fs-5"></i>{{$pizza->price}} kyats</span>
                                        <span class="my-3 btn btn-dark"  data-toggle="tooltip" title="Waiting Time" data-placement="bottom"><i class="fa-solid fa-clock me-2 fs-5"></i>{{$pizza->waiting_time}} mins</span>
                                        <span class="my-3 btn btn-dark"  data-toggle="tooltip" title="View" data-placement="bottom"><i class="fa-solid fa-eye me-2 fs-5"></i>{{$pizza->view_count}}</span>
                                        <span class="my-3 btn btn-dark"  data-toggle="tooltip" title="Category" data-placement="bottom"><i class="fa-solid fa-clone me-2 fs-5"></i>{{$pizza->category_name}}</span>
                                        <span class="my-3 btn btn-dark" data-toggle="tooltip" title="Date" data-placement="bottom"><i class="fa-solid fa-user-clock me-2 fs-5"></i>{{$pizza->created_at->format("j-F-Y")}}</span>
                                        <div class="my-3"><i class="fa-solid fa-file-lines me-2 fs-5"></i>Details
                                            <div>{{$pizza->description}}</div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection