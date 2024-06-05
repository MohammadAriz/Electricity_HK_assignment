@extends('admin.layouts.master')
@section('main-content')
    <div id="page-wrapper">
        <div id="page-inner">


            <h1 class="text-center">Generate Bill</h1>
            <form action="{{ route('store.bill') }}" method="post" enctype="multipart/form-data">
                @csrf
                @php
                    $users = App\Models\Customer::all();
                @endphp
                <div class="form-group">
                    <label for="">Select User</label>
                    <select name="user_id" id="" class="form-control">
                        <option value="">selected</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Month</label>
                    <input type="month" name="month" id="" class="form-control" placeholder="enter task">
                </div>
                <div class="form-group">
                    <label for="">Unit Consumption</label>
                    <input type="number" name="unit_consumption" class="form-control" placeholder="enter unit consumption">
                </div>


                <button class="btn btn-primary" style="margin-left:30vw " type="submit">SUBMIT</button>

            </form>
        </div>
    </div>
@endsection
