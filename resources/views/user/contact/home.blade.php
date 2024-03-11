@extends("user.layouts.master")
@section("title","Contact Page")
@section("content")
    <div class="contact" style="height:450px">
        <div class="container">
            <div class="row">
                <div class="col-8 mx-auto">
                    <div class="row">
                        <div class="col">
                            <h3 class="text-uppercase mb-4 text-center">contact us</h3>
                        </div>
                    </div>
                    <form action="{{route("user#sendMessage")}}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="text" name="name" class="form-control @error("name") is-invalid @enderror" placeholder="Enter name..." value="{{Auth::user()->name}}" disabled>
                                    <label for="floatingInput">Name</label>
                                    {{-- @error("name")
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror --}}
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="email" name="email" class="form-control @error("email") is-invalid @enderror" placeholder="Enter email..." value="{{Auth::user()->email}}" disabled>
                                    <label class="floatingInput">Email</label>
                                    {{-- @error("email")
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror --}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <textarea cols="30" rows="10" name="message" class="form-control @error("message") is-invalid @enderror" placeholder="Message">{{old("message")}}</textarea>
                                    @error("message")
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group float-end">
                            <button type="submit" class="btn btn-dark px-4 py-2">Send<i class="fa-solid fa-share ms-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
@endsection