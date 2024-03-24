@extends('layouts.app')

@section('content')

    <h1 class="mt-5 ms-3">Results</h1>

    <div class="row g-4 row-cols-lg-5 row-cols-md-3 my-2 m-0">

        @if($products == false)
            <div class="text-center w-100">
                <h2>unfortunately, no results</h2>
            </div>
        @endif

        @if($products)
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
                            <div class="text-center position-relative ">
                                <div class=" position-absolute top-0 start-0">
                                    <span class="badge bg-danger">{{$product->status}}</span>
                                </div>

                                <a href="{{route('show', $product->title)}}">
                                    <!-- img -->
                                    <img src="{{asset('products-img')}}\{{$product->photo}}" height="300px" width="300px" alt="{{$product->photo}}" class="mb-3 img-fluid">
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
                            <h4><span class="text-dark">{{$product->price}}$/kg</span></h4>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div><span class="text-dark">Quantity: {{$product->quantity}}kg</span></div>
                            </div>

                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        @endif
    </div>

    <style>
        
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
