@extends('admin.layouts.master')
@section('main-content')
    <div id="page-wrapper">
        <div id="page-inner">


            <h1 class="text-center">Customer Form</h1>
            <form action="{{ route('customers.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" id="" class="form-control" placeholder="enter your name">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Address</label>
                    <input type="text" name="address" id="" class="form-control"
                        placeholder="enter your address">
                    @error('address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="email" id="" class="form-control" placeholder="enter your email">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Mobile Number</label>
                    <input type="text" name="mobile" id="" class="form-control"
                        placeholder="enter your mobile number" maxlength="10">
                    @error('mobile')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">City</label>
                    <input type="text" name="city" id="" class="form-control" placeholder="enter your city">
                    @error('city')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button class="btn btn-primary" style="margin-left:30vw " type="submit">SUBMIT</button>

            </form>
        </div>
    </div>
@endsection
