@extends('layouts.app')

@section('content')


{{-- add a navigation ex:home/product... --}}
<div class="container mt-5 w-100">
    @if(Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif

    @if(Session::has('fail'))
        <div class="alert alert-danger">{{Session::get('fail')}}</div>
    @endif

    <div class="row d-flex flex-wrap">

        <div class="col-md-6 mb-3">

            <img src="{{asset('products-img')}}\{{$product->photo}}" alt="Product_Image" class="h-100 w-100 d-block m-auto rounded img-fluid">

        </div>

        <div class="col-md-6">

            <h1 class="mb-3">{{$product->title}}</h1>

            <p>Added by <img src="{{asset('profile-img')}}/{{$product->user->photo}}" height="30px" width="31px" class="rounded-circle"> {{$product->user->first_name}} {{$product->user->last_name}}</p>

            <p class="lead mb-4">{{$product->description}}</p>

            <h2 class="mb-3">{{$product->price}} dh/kg</h2>

            <p>Quantity available: {{$product->quantity}}kg</p>

            <form method="POST" action="{{route('addToCart')}}">
                @csrf
                <div class="form-group">
                    <label for="quantity">Quantity:</label>
                    <div class="input-group quantityContainer">
                        <input type="number" class="form-control" name="quantity" id="quantity" min="1" max="{{$product->quantity}}" value="1">
                        <div class="input-group-append">
                            <span class="input-group-text rounded-0 rounded-end">KG</span>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="price" value="{{$product->price}}">
                <input type="hidden" name="quantityOfProduct" value="{{$product->quantity}}">
                <input type="hidden" name="user_id" value="{{Session::get('user')->id}}">
                <input type="hidden" name="product_id" value="{{$product->id}}">
                <button type="submit" class="btn btn-primary btn-sm my-3"><i class="bi bi-cart me-2" style="font-size:15px"></i>Add to cart</button>
            </form>

        </div>

    </div>
</div>

@php
    $checkUser = app('App\Http\Controllers\RatingController')->checkUser(Session::get('user')->id , $product->id)
@endphp

@if($checkUser->count())
    <div class="container mt-5 m-0 text-center w-25 ">
        <form action="{{route('AddRating')}}" method="POST">
            @csrf
            <div class="rating">
                <input type="radio" name="rating" value="5" id="5">
                <label for="5">☆</label>
                <input type="radio" name="rating" value="4" id="4">
                <label for="4">☆</label>
                <input type="radio" name="rating" value="3" id="3">
                <label for="3">☆</label>
                <input type="radio" name="rating" value="2" id="2">
                <label for="2">☆</label>
                <input type="radio" name="rating" value="1" id="1">
                <label for="1">☆</label>
            </div>

            <div class="mb-3">
                <label for="review" class="form-label text-start">Your review about product</label>
                <textarea class="form-control" name="review" id="review" class="review" rows="3"></textarea>
            </div>

            <input type="hidden" name="product_id" value="{{$product->id}}">

            <div class="buttons px-4 mt-0">
                <button type="submit" class="btn btn-warning btn-block">Submit</button>
            </div>
        </form>
    </div>
@endif

    @if(Session::has('loginUser'))
        @include('components.footer')
    @endif

<style>

    .quantityContainer{
        width: 25%;
    }

    @media (max-width: 1000px){
        .quantityContainer{
            width: 100%;
        }
    }

    .rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: center
    }

    .rating>input {
        display: none
    }

    .rating>label {
        position: relative;
        width: 1em;
        font-size: 30px;
        font-weight: 300;
        color: #FFD600;
        cursor: pointer
    }

    .rating>label::before {
        content: "\2605";
        position: absolute;
        opacity: 0;
    }

    .rating>label:hover:before,
    .rating>label:hover~label:before {
        opacity: 1 !important
    }

    .rating>input:checked~label:before {
        opacity: 1
    }

    .rating:hover>input:checked~label:before {
        opacity: 0
    }

</style>

@endsection
