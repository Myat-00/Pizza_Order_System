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
                                <a href="{{route("product#list")}}" class="text-dark">
                                    <i class="fa-solid fa-arrow-left fs-5"></i>
                                </a>
                            </div>
                            <div class="card-title">
                                <h3 class="text-center title-2">Update Product</h3>
                            </div>
                            <hr>
                            <form action="{{route("product#update")}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">  
                                        <div class="d-flex justify-content-center">                                     
                                            <img src="{{asset("storage/".$pizza->image)}}" class="img-thumbnail" />
                                        </div>                                      
                                        <div class=" mt-3">
                                            <input type="file" name="pizzaImage" class="form-control @error("pizzaImage") is-invalid @enderror">
                                            @error("pizzaImage")
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
                                            <input type="hidden" name="pizzaId" value="{{$pizza->id}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="pizzaName" type="text" class="form-control @error("pizzaName") is-invalid @enderror" value="{{old("pizzaName",$pizza->name)}}" placeholder="Enter Pizza Name...">    
                                            @error("pizzaName")
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Description</label>
                                            <textarea name="pizzaDescription" cols="30" rows="10" class="form-control @error("pizzaDescription") is-invalid @enderror" placeholder="Enter Pizza Description...">{{old("pizzaDescription",$pizza->description)}}</textarea> 
                                            @error("pizzaDescription")
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Category</label>
                                            <select name="pizzaCategory" class="form-control @error("pizzaCategory") is-invalid @enderror">
                                                <option value="">Choose Pizza Category...</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{$category->id}}" @if($pizza->category_id == $category->id) selected @endif>{{$category->name}}</option>
                                                @endforeach
                                            </select>  
                                            @error("pizzaCategory")
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Price</label>
                                            <input id="cc-pament" name="pizzaPrice" type="number" class="form-control @error("pizzaPrice") is-invalid @enderror" value="{{old("pizzaPrice",$pizza->price)}}" placeholder="Enter Pizza Price...">    
                                            @error("pizzaPrice")
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                            <input id="cc-pament" name="pizzaWaitingTime" type="number" class="form-control @error("pizzaWaitingTime") is-invalid @enderror" value="{{old("pizzaWaitingTime",$pizza->waiting_time)}}" placeholder="Enter Watiting Time...">    
                                            @error("pizzaWaitingTime")
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">View Couont</label>
                                            <input id="cc-pament" name="viewCount" type="number" class="form-control" value="{{old("viewCount",$pizza->view_count)}}" disabled>   
                                            @error("viewCount")
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror 
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Created At</label>
                                            <input id="cc-pament" name="createdAt" type="text" class="form-control" value="{{$pizza->created_at->format("j-F-Y")}}" disabled>    
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