@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center vh-75">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-success text-center">
                        <h1><i class="bi bi-check-circle"></i></h1>
                        <h2>Your order has been confirmed!</h2>
                        <p>Our team will call you shortly to confirm the delivery date.</p>
                    </div>
                    <div class="text-center">
                        <a href="{{route("store")}}" class="text-decoration-none btn btn-primary">
                            <i class="bi bi-cart"></i>
                            Go back to shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
