@extends("admin.layouts.master")
@section("title","Change Password Page")
@section("content")
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                {{-- <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{route("category#list")}}"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div> --}}
                
                <div class="col-lg-6 offset-3 ">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Change Password</h3>
                            </div>
                            @if (session("changeSuccess"))
                                <div class="col-12  alert alert-success alert-dismissible fade show" role="alert">
                                    <strong><i class="fa-solid fa-check me-2"></i>{{session("changeSuccess")}}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            @if (session("notMatch"))
                                <div class="col-12  alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fa-solid fa-triangle-exclamation me-2"></i>{{session("notMatch")}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <hr>
                            <form action="{{route("admin#changePassword")}}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                    <input id="cc-pament" name="oldPassword" type="password" class="form-control  @error("oldPassword") is-invalid @enderror"  placeholder="Enter Old Password...">
                                    @error("oldPassword")
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">New Password</label>
                                    <input id="cc-pament" name="newPassword" type="password" class="form-control @error("newPassword") is-invalid @enderror"  placeholder="Enter New Password...">
                                    @error("newPassword")
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
                                    <input id="cc-pament" name="confirmPassword" type="password" class="form-control @error("confirmPassword") is-invalid @enderror"  placeholder="Enter Confirm Password...">
                                    @error("confirmPassword")
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                
                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <i class="fa-solid fa-key me-2"></i>
                                        <span id="payment-button-amount">Change Password</span>
                                        {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                        
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection