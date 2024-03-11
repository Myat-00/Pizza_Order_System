@extends("admin.layouts.master")
@section("title","Change Profile Page")
@section("content")
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">                
                <div class="col-lg-10 offset-1 ">
                    <div class="card">
                        <div class="card-body">
                            <div class="ms-5">
                                <i class="fa-solid fa-arrow-left fs-5" onclick="history.back()"></i>
                            </div>
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Profile</h3>
                            </div>
                            <hr>
                            <form action="{{route("admin#update",Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        @if (Auth::user()->image==null)
                                            @if(Auth::user()->gender == "male")
                                                <img src="{{asset("images/default_user.png")}}" style="height:250px" class="img-thumbnail w-100" />
                                            @else
                                                <img src="{{asset("images/default_female_user.webp")}}" style="height:250px" class="img-thumbnail w-100" />
                                            @endif                                     
                                        @else     
                                            <img src="{{asset("storage/".Auth::user()->image)}}" style="height:250px" class="img-thumbnail w-100" />                                  
                                        @endif
                                        <div class=" mt-3">
                                            <input type="file" name="image" class="form-control @error("image") is-invalid @enderror">
                                            @error("image")
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                            <button class="btn btn-dark col-12 py-2" type="submit">Update<i class="fa-solid fa-circle-chevron-right ms-2"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="name" type="text" class="form-control @error("name") is-invalid @enderror" value="{{old("name",Auth::user()->name)}}" placeholder="Enter Admin Name...">    
                                            @error("name")
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Email</label>
                                            <input id="cc-pament" name="email" type="email" class="form-control @error("email") is-invalid @enderror" value="{{old("email",Auth::user()->email)}}" placeholder="Enter Admin Email...">    
                                            @error("email")
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" name="phone" type="number" class="form-control @error("phone") is-invalid @enderror" value="{{old("phone",Auth::user()->phone)}}" placeholder="Enter Admin Phone Number...">    
                                            @error("phone")
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Gender</label>
                                            <select name="gender" class="form-control @error("gender") is-invalid @enderror">
                                                <option value="">Choose Gender...</option>
                                                <option value="male" @if(Auth::user()->gender=="male") selected @endif>Male</option>
                                                <option value="female" @if(Auth::user()->gender=="female") selected @endif>Female</option>
                                            </select>  
                                            @error("gender")
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Address</label>
                                            <input id="cc-pament" name="address" type="text" class="form-control @error("address") is-invalid @enderror" value="{{old("address",Auth::user()->address)}}" placeholder="Enter Admin Address...">    
                                            @error("address")
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Role</label>
                                            <input id="cc-pament" name="role" type="text" class="form-control" value="{{old("role",Auth::user()->role)}}" disabled>    
                                        </div>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection