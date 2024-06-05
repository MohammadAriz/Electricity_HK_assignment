@extends('admin.layouts.master')
@section('main-content')
    {{-- <div id="page-inner"> --}}
    <div id="page-wrapper">

        <a href="{{ url('/create-customers') }}"><button class="btn btn-primary">Add Customer</button></a>


        <table class="table">

            <thead>

                <tr>
                    <th scope="col">#</th>
                    <th scope="col">NAME</th>
                    <th scope="col">Month</th>
                    <th scope="col">Amount</th>



                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                @endphp

                @foreach ($users as $user)
                    @php
                        $user_name = App\Models\Customer::find($user->user_id);

                    @endphp
                    <tr>
                        <th scope="row">{{ ++$i }}</th>
                        <td>
                            @if ($user_name)
                                {{ $user_name->name }}
                            @else
                                User
                            @endif
                        </td>
                        <td>{{ $user->month }}</td>
                        <td>{{ $user->amount }}</td>





                    </tr>
                @endforeach

            </tbody>
        </table>
        {{-- {{ $users->links('pagination::bootstrap-4') }} --}}
    </div>
@endsection
