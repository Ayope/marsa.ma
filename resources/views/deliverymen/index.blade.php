@extends('layouts.app')

@section('content')

<div class="mt-2 w-100 d-flex justify-content-center">
    @if(Session::has('success'))
    <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif

    @if(Session::has('fail'))
    <div class="alert alert-danger">{{Session::get('fail')}}</div>
    @endif
</div>

<div class="d-flex justify-content-center mt-3 m-auto align-items-center flex-column" style="width:95%">
    <h1>Your Delivery Men</h1>
    <div class="w-75 text-end mb-3">
        <a class="btn btn-primary px-5" href="{{route('addDeliveryMan')}}"><i class="bi bi-plus"></i>Add</a>
    </div>

    <div class="container-fluid table-responsive" >
        <table class="table table-bordered border-dark">
            <thead>
                <tr>
                    <th scope="col">Photo</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col" style="width: 15%;">Phone Number</th>
                    <th scope="col" style="width: 20%;">Address</th>
                    <th scope="col">Max Deliveries in Day</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($deliverymen as $deliveryman)
                    @if($deliveryman->fisher_id == Session::get('user')->id)
                    <tr>
                        <td><img src="{{asset('profile-img') }}/{{$deliveryman->user->photo}}" alt="{{ $deliveryman->user->first_name }} {{ $deliveryman->user->first_name }}" width="150px" height="auto"></td>
                        <td>{{ $deliveryman->user->first_name }}</td>
                        <td>{{ $deliveryman->user->last_name }}</td>
                        <td>{{ $deliveryman->user->email }}</td>
                        <td>{{ $deliveryman->user->phone_number }}</td>
                        <td>{{ $deliveryman->user->address }}</td>
                        <td>{{ $deliveryman->max_deliveries_in_day }}</td>
                        <td>
                            <div class="d-flex flex-wrap">
                                <form action="{{ route('deleteDeliveryman', $deliveryman->user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">
                                        Remove
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                <a href="{{ route('showDeliveryman', $deliveryman->user->id) }}" class="btn btn-secondary mt-2">
                                    See More
                                    <i class="bi bi-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
