@extends('layouts.app')

@section('content')
    <div class="hero-image mb-5">
        <div class="container mt-3">
        <h1>Welcome to Marsa.ma</h1>
        <p>Find the best quality fishes at affordable prices.</p>
        <a href="#products" class="btn btn-primary btn-lg">Shop Now</a>
        </div>
    </div>

    <h1 id="products" class="mt-5 ms-3">Products</h1>

    <div class="row g-4 row-cols-lg-5 row-cols-md-3 my-2 m-0">

        @foreach ($products as $product)

        @if($product->status == 'available')

        <div class="col">
            <!-- card product -->
            <div class="card card-product" style="height:100%">
                <div class="card-body">

                    <!-- badge -->
                    <div class="text-center position-relative ">
                        <div class=" position-absolute top-0 start-0">
                            <span class="badge bg-danger">{{$product->status}}</span>
                        </div>

                        <a href="shop-single.html">
                            <!-- img -->
                            <img src="{{asset('products-img')}}\{{$product->photo}}" height="300px" width="300px" alt="{{$product->photo}}" class="mb-3 img-fluid">
                        </a>

                    </div>
                    <!-- heading -->
                    <h2 class="fs-6"><a href="shop-single.html" class="text-inherit text-decoration-none">{{Str::limit($product->title, 50, '...')}}</a></h2>

                    <div>
                    <!-- rating -->
                    <small class="text-warning"> <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-half"></i>
                    </small>

                    <span class="text-muted small"></span>

                    </div>
                    <!-- price -->
                    <h4><span class="text-dark">{{$product->price}}$/kg</span></h4>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div><span class="text-dark">Quantity: {{$product->quantity}}kg</span></div>

                        <!-- btn -->
                        <div>
                            <a href="#!" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg" style="font-size:10px"></i>Add</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>

<style>
    .hero-image {
        background-image: url('/images/pexels-photo-6313467.jpeg');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        height: 500px;
        display: flex;
        justify-content: center;
        /* align-items: center; */
        color: #ffffff;
    }

    .hero-image h1 {
        font-size: 4rem;
        margin-bottom: 1rem;
    }

    .hero-image p {
        font-size: 1.5rem;
        margin-bottom: 2rem;
    }

    @media (max-width: 768px) {
        .hero-image {
        height: 300px;
        }
        .hero-image h1 {
        font-size: 3rem;
        }
        .hero-image p {
        /* font-size: 1.2rem; */
        display: none;
        }
    }
    @media(max-width: 400px){
        .hero-image{
            display: none;
        }

    }
    </style>

@endsection
