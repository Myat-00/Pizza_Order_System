@extends("admin.layouts.master")
@section("title","Update User List Page")
@section("content")
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">                
                <div class="col-lg-10 offset-1 ">
                    <div class="card">
                        <div class="card-body">
                            <div class="ms-5">
                                <a href="{{route("admin#userList")}}" class="text-dark">
                                    <i class="fa-solid fa-arrow-left fs-5"></i>
                                </a>
                            </div>
                            <div class="card-title">
                                <h3 class="text-center title-2">Update User List</h3>
                            </div>
                            <hr>
                            <form action="{{route("admin#updateUserList")}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">  
                                        <div class="d-flex justify-content-center">   
                                            @if($user->image == null)                                  
                                                @if($user->gender == "male")
                                                    <img src="{{asset("images/default_user.png")}}" class="img-thumbnail w-100" style="height:250px">
                                                @elseif($user->gender == 'female')
                                                    <img src="{{asset("images/default_female_user.webp")}}" class="img-thumbnail w-100" style="height:250px">
                                                @endif
                                            @else
                                                <img src="{{asset("storage/".$user->image)}}" class="img-thumbnail w-100" style="height:250px" />
                                            @endif
                                        </div>                                      
                                        <div class=" mt-3">
                                            <input type="file" name="image" class="form-control @error("userImage") is-invalid @enderror">
                                            @error("userImage")
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
                                        <div class="">
                                            <input type="hidden" name="userId" value="{{$user->id}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="name" type="text" class="form-control @error("name") is-invalid @enderror" value="{{old("name",$user->name)}}" placeholder="Enter User Name...">    
                                            @error("name")
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Email</label>
                                            <input id="cc-pament" name="email" type="email" class="form-control @error("email") is-invalid @enderror" value="{{old("email",$user->email)}}" placeholder="Enter User email...">    
                                            @error("email")
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Gender</label>
                                            <select name="gender" class="form-control @error("gender") is-invalid @enderror">
                                                <option value="">Choose Gender...</option>
                                                <option value="male" @if($user->gender == "male") selected @endif>Male</option>
                                                <option value="female" @if($user->gender == "female") selected @endif>Female</option>
                                            </select>  
                                            @error("gender")
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" name="phone" type="number" class="form-control @error("phone") is-invalid @enderror" value="{{old("phone",$user->phone)}}" placeholder="Enter phone number...">    
                                            @error("phone")
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Address</label>
                                            <input id="cc-pament" name="address" type="text" class="form-control @error("address") is-invalid @enderror" value="{{old("address",$user->address)}}" placeholder="Enter Address...">    
                                            @error("address")
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Role</label>
                                            <select name="role" class="form-control">
                                                <option value="">Choose Role...</option>
                                                <option value="admin" @if($user->role == "admin") selected @endif>Admin</option>
                                                <option value="user" @if($user->role == "user") selected @endif>User</option>
                                            </select>  
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