@extends('layouts.app')

@section('content')

<div class="container mt-5 w-100">

    
    @php
        $ratingAverage = app('App\Http\Controllers\RatingController')->showRatingAverage($product->id);

        $checkRating = app('App\Http\Controllers\RatingController')->checkRating(Session::get('user')->id , $product->id);

        $checkUser = app('App\Http\Controllers\RatingController')->checkUser(Session::get('user')->id , $product->id);
    @endphp

    @if(Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif

    @if(Session::has('fail'))
        <div class="alert alert-danger">{{Session::get('fail')}}</div>
@endif

    <div class="row d-flex flex-wrap">

        <div class="col-md-6 mb-3" style="max-height: 400px; max-width: auto;">
            <img src="{{asset('products-img')}}\{{$product->photo}}" alt="Product_Image"  class="h-100 d-block m-auto rounded ">
        </div>

        <div class="col-md-6">
            <h1 class="mb-3">{{$product->title}}</h1>
            
            @if($ratingAverage)
            <hr>
                <div class="">
                    <p class="fs-5"><strong>Average Rating: </strong> {{$ratingAverage}} out of 5</p>
                    <div>
                        <label class='ratings {{ $ratingAverage >= 1 ? "checked" : "" }}'>★</label>
                        <label class='ratings {{ $ratingAverage >= 2 ? "checked" : "" }}'>★</label>
                        <label class='ratings {{ $ratingAverage >= 3 ? "checked" : "" }}'>★</label>
                        <label class='ratings {{ $ratingAverage >= 4 ? "checked" : "" }}'>★</label>
                        <label class='ratings {{ $ratingAverage >= 5 ? "checked" : "" }}'>★</label>
                    </div>
                </div>
            <hr>
            @endif

            <p>Product by <img src="{{asset('profile-img')}}/{{$product->user->photo}}" height="30px" width="31px" class="rounded-circle"> {{$product->user->first_name}} {{$product->user->last_name}}</p>

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
                @if($checkUser->count())
                    @if(!$checkRating)
                    <!-- turn it instead to a button says edit rating that shows you the modal 
                    to edit your rating and review -->
                        <button type="button" class="btn p-1" style="background-color: yellow" data-bs-toggle="modal" data-bs-target="#InsertModal">
                            <i class="bi bi-star"></i> Rate the product
                        </button>
                    @else
                        <button type="button" class="btn p-1" style="background-color: yellow" data-bs-toggle="modal" data-bs-target="#UpdateModal">
                            <i class="bi bi-pen"></i> Edit your review
                        </button>
                    @endif
                @endif
            </form>
        </div>

    </div>
</div>

@if(!$checkRating)
<div class="modal fade" id="InsertModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-star"></i> Rate the product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="container m-0 text-center w-100 ">
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

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-warning btn-block">Submit</button>
            </div>
        </form>
    </div>
  </div>
</div>
@else
<div class="modal fade" id="UpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-pen"></i> Update your review</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="container m-0 text-center w-100 ">
                <form action="{{route('UpdateRating')}}" method="POST" id="rating-form">
                    @csrf
                    <input type="hidden" name="Rating_id" value="{{$authUserRating->id}}">
                    <div class="rating">
                        <input type="radio" name="rating" value="5" id="5" {{ $authUserRating->ratings == 5 ? "checked" : "" }}>
                        <label for="5">☆</label>
                        <input type="radio" name="rating" value="4" id="4" {{ $authUserRating->ratings == 4 ? "checked" : "" }}>
                        <label for="4">☆</label>
                        <input type="radio" name="rating" value="3" id="3" {{ $authUserRating->ratings == 3 ? "checked" : "" }}>
                        <label for="3">☆</label>
                        <input type="radio" name="rating" value="2" id="2" {{ $authUserRating->ratings == 2 ? "checked" : "" }}>
                        <label for="2">☆</label>
                        <input type="radio" name="rating" value="1" id="1" {{ $authUserRating->ratings == 1 ? "checked" : "" }}>
                        <label for="1">☆</label>
                    </div>

                    <div class="mb-3">
                        <label for="review" class="form-label text-start">Your review about product</label>
                        <textarea class="form-control" name="review" id="review" class="review" rows="3">{{$authUserRating->review}}</textarea>
                    </div>

                    <input type="hidden" name="product_id" value="{{$product->id}}">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-warning btn-block" id="update-btn" disabled>Update</button>
            </div>
        </form>
    </div>
  </div>
</div>
@endif


<div class="container my-5">
  <div class="row">
    <div class="col-md-8">
    @if($rating->count())
      <h2>Customer Reviews</h2>
      @foreach($rating as $rating)
      <div class="card mb-3">
        <div class="card-body">
            <div class="media">
                <div class="d-flex justify-content-between">
                    <img src="{{asset('profile-img')}}/{{$rating->user->photo}}" class="mb-3 rounded-circle" height="50px" width="50px"  alt="Profile Picture">
                    @if($rating->user->id == Session::get('user')->id)
                        <a href={{route('deleteRating', $rating->id)}}><i class="bi bi-trash text-danger" style="font-size:25px"></i></a>
                    @endif
                </div>
            <div class="media-body">
              <h5 class="mt-0">{{$rating->user->first_name . ' ' . $rating->user->last_name}}</h5>
              <div class="mb-2">
                <label class='ratings {{ $rating->ratings >= 1 ? "checked" : "" }}'>★</label>
                <label class='ratings {{ $rating->ratings >= 2 ? "checked" : "" }}'>★</label>
                <label class='ratings {{ $rating->ratings >= 3 ? "checked" : "" }}'>★</label>
                <label class='ratings {{ $rating->ratings >= 4 ? "checked" : "" }}'>★</label>
                <label class='ratings {{ $rating->ratings >= 5 ? "checked" : "" }}'>★</label>
              </div>
              <p>
                {{$rating->review}}
              </p>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    @endif
    </div>
  </div>
</div>

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


    .ratings{
        font-size: 30px;
        font-weight: 300;
        color: gray;
    }

    .checked{
        color: yellow;
    }

</style>

@if($authUserRating)
<script>
  const form = document.querySelector('#rating-form');
  const updateBtn = document.querySelector('#update-btn');
  const initialValues = {
    rating: '{{$authUserRating->ratings}}',
    review: '{{$authUserRating->review}}',
  };

  form.addEventListener('input', () => {
    const currentValues = {
      rating: form.rating.value,
      review: form.review.value,
    };

    updateBtn.disabled = (
      currentValues.rating === initialValues.rating &&
      currentValues.review === initialValues.review
    );
  });
</script>
@endif

@endsection
