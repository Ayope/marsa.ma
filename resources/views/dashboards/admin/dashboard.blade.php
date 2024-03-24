@extends('layouts.app')

@section('content')

    
    <div class="container mt-5">

      <div class="row">

        <div class="col-md-3 mb-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Customers</h5>
              <h6 class="card-subtitle mb-2 text-muted">Total number of users</h6>
              <p class="card-text">{{app('App\Http\Controllers\UserController')->roleCount('client')}}</p>
            </div>
          </div>
        </div>

        <div class="col-md-3 mb-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Fishers</h5>
              <h6 class="card-subtitle mb-2 text-muted">Total number of fishers</h6>
              <p class="card-text">{{app('App\Http\Controllers\UserController')->roleCount('fisher')}}</p>
            </div>
          </div>
        </div>

        <div class="col-md-3 mb-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Delivery men</h5>
              <h6 class="card-subtitle mb-2 text-muted">Total number of Delivery men</h6>
              <p class="card-text">{{app('App\Http\Controllers\UserController')->roleCount('deliveryMan')}}</p>
            </div>
          </div>
        </div>

        <div class="col-md-3 mb-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Products</h5>
              <h6 class="card-subtitle mb-2 text-muted">Total number of Products</h6>
                <p class="card-text">{{app('App\Http\Controllers\ProductController')->productCount()}}</p>
            </div>
          </div>
        </div>

        <div class="col-md-3 mb-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Commands</h5>
              <h6 class="card-subtitle mb-2 text-muted">Total number of commands</h6>
              <p class="card-text">{{app('App\Http\Controllers\CommandController')->CommandCount()}}</p>
            </div>
          </div>
        </div>
        
        <div class="col-md-3 mb-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Deliveries</h5>
              <h6 class="card-subtitle mb-2 text-muted">Total number of deliveries</h6>
                <p class="card-text">{{app('App\Http\Controllers\CommandController')->CommandCount('delivred')}}</p>
            </div>
          </div>
        </div>
    </div>
    </div>


@endsection