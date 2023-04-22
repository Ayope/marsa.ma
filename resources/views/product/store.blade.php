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

    @if(Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif

    @if(Session::has('fail'))
        <div class="alert alert-danger">{{Session::get('fail')}}</div>
    @endif


    <div class="row g-4 row-cols-lg-5 row-cols-md-3 my-2 m-0">

        @foreach ($products as $product)

        @if($product->status == 'available')
        
        @php
            $ratingAverage = app('App\Http\Controllers\RatingController')->showRatingAverage($product->id);
        @endphp
        <div class="col">
            <!-- card product -->
            <div class="card card-product" style="height:100%">
                <div class="card-body">

                    <!-- badge -->
                    <div class="text-center position-relative">
                        <div class="position-absolute top-0 start-0">
                            <span class="badge bg-danger">{{$product->status}}</span>
                        </div>

                        <a href="{{route('show', $product->title)}}">
                            <!-- img -->
                            <img src="{{asset('products-img')}}\{{$product->photo}}" alt="{{$product->photo}}" class="mb-3" style="max-width: 100%; max-height: 200px;">
                        </a>

                    </div>
                    <!-- heading -->
                    <h2 class="fs-6"><a href="{{route('show', $product->title)}}" class="text-inherit text-decoration-none">{{Str::limit($product->title, 50, '...')}}</a></h2>

                    <div>
                    <!-- rating -->
                    @if($ratingAverage)
                    <small class="text-warning">
                        <label class='ratings {{ $ratingAverage >= 1 ? "checked" : "" }}'>★</label>
                        <label class='ratings {{ $ratingAverage >= 2 ? "checked" : "" }}'>★</label>
                        <label class='ratings {{ $ratingAverage >= 3 ? "checked" : "" }}'>★</label>
                        <label class='ratings {{ $ratingAverage >= 4 ? "checked" : "" }}'>★</label>
                        <label class='ratings {{ $ratingAverage >= 5 ? "checked" : "" }}'>★</label>
                    </small>
                    @endif
                    <span class="text-muted small"></span>

                    </div>
                    <!-- price -->
                    <h4><span class="text-dark">{{$product->price}} dh/kg</span></h4>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div><span class="text-dark">Quantity: {{$product->quantity}}kg</span></div>

                        <!-- btn -->
                        <div>
                            <form method="POST" action="{{route('addToCart')}}">
                                @csrf
                                <input type="hidden" name="price" value="{{$product->price}}">
                                <input type="hidden" name="quantityOfProduct" value="{{$product->quantity}}">
                                <input type="hidden" name="user_id" value="{{Session::get('user')->id}}">
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <button type="submit" class="btn btn-primary btn-sm"><i class="bi bi-cart me-2" style="font-size:15px"></i>Add</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>

    @if(Session::has('loginUser'))
        @include('components.footer')
    @endif

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
            display: none;
        }
    }
    @media(max-width: 400px){
        .hero-image{
            display: none;
        }

    }

    .ratings{
        font-size: 25px;
        font-weight: 300;
        color: gray;
    }

    .checked{
        color: yellow;
    }

    </style>

@endsection
