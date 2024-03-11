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
                            <a href="{{route("admin#list")}}" class="text-dark">
                                <div class="ms-5">
                                    <i class="fa-solid fa-arrow-left fs-5"></i>
                                </div>
                            </a>
                            <div class="card-title">
                                <h3 class="text-center title-2">Change Role</h3>
                            </div>
                            <hr>
                            <form action="{{route("admin#changeRole",$user->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        @if ($user->image==null)
                                            @if($user->gender == "male")
                                            <div class="image">
                                                <a href="#">
                                                    <img src="{{asset("images/default_user.png")}}" alt="John Doe" />
                                                </a>
                                            </div>
                                            @else
                                            <div class="image">
                                                <a href="#">
                                                    <img src="{{asset("images/female_default.jpg")}}" alt="John Doe" />
                                                </a>
                                            </div>
                                            @endif                                     
                                        @else     
                                            <div class="d-flex justify-content-center">                                     
                                                <img src="{{asset("storage/".$user->image)}}" alt="John Doe" />
                                            </div>                                      
                                        @endif
                                        {{-- <div class=" mt-3">
                                            <input type="file" name="image" class="form-control @error("image") is-invalid @enderror" disabled>
                                            @error("image")
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div> --}}
                                        <div class="mt-3">
                                            <button class="btn btn-dark col-12 py-2" type="submit">Change<i class="fa-solid fa-circle-chevron-right ms-2"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Role</label>
                                            <select name="role" class="form-control">
                                                <option value="">Choose Role...</option>
                                                <option value="admin" @if($user->role == "admin") selected @endif>Admin</option>
                                                <option value="user" @if($user->role == "user") selected @endif>User</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="name" type="text" class="form-control @error("name") is-invalid @enderror" value="{{old("name",$user->name)}}" placeholder="Enter Admin Name..." disabled>    
                                            @error("name")
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Email</label>
                                            <input id="cc-pament" name="email" type="email" class="form-control @error("email") is-invalid @enderror" value="{{old("email",$user->email)}}" placeholder="Enter Admin Email..." disabled>    
                                            @error("email")
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" name="phone" type="number" class="form-control @error("phone") is-invalid @enderror" value="{{old("phone",$user->phone)}}" placeholder="Enter Admin Phone Number..." disabled>    
                                            @error("phone")
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Gender</label>
                                            <select name="gender" class="form-control @error("gender") is-invalid @enderror" disabled>
                                                <option value="">Choose Gender...</option>
                                                <option value="male" @if($user->gender=="male") selected @endif>Male</option>
                                                <option value="female" @if($user->gender=="female") selected @endif>Female</option>
                                            </select>  
                                            @error("gender")
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Address</label>
                                            <input id="cc-pament" name="address" type="text" class="form-control @error("address") is-invalid @enderror" value="{{old("address",$user->address)}}" placeholder="Enter Admin Address..." disabled>    
                                            @error("address")
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
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