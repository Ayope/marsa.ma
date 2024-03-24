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
    <h1>the latest ratings on the products</h1>
    <div class="w-75 text-end mb-3">
        <a class="btn btn-primary px-5" href="{{route('productCreate')}}"><i class="bi bi-plus"></i>Add</a>
    </div>
    <div class="container-fluid table-responsive" >
        <table class="table table-bordered border-dark">
                <thead>
                    <tr>
                        <th scope="col" style="width: 25%">Review</th>
                        <th class="col" style="width: 15%">rating</th>
                        <th scope="col">User</th>
                        <th scope="col">Product</th>
                        <th scope="col" >Added at</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ratings as $rating)
                        <tr>
                            <td>{{ $rating->review }}</td>
                            <td>    
                                <label class='ratings {{ $rating->ratings >= 1 ? "checked" : "" }}'>★</label>
                                <label class='ratings {{ $rating->ratings >= 2 ? "checked" : "" }}'>★</label>
                                <label class='ratings {{ $rating->ratings >= 3 ? "checked" : "" }}'>★</label>
                                <label class='ratings {{ $rating->ratings >= 4 ? "checked" : "" }}'>★</label>
                                <label class='ratings {{ $rating->ratings >= 5 ? "checked" : "" }}'>★</label>
                            </td>
                            <td><img src="{{asset('profile-img')}}/{{$rating->user->photo}}" class="rounded-circle" height="50px" width="50px"><p>{{$rating->user->first_name . ' ' . $rating->user->last_name}}</p></td>
                            <td>
                                <a href="{{route('show', $rating->product->title)}}" class="text-decoration-none">
                                    <img src="{{asset('products-img')}}/{{$rating->product->photo}}" height="100px" width="100px">
                                    <p>{{$rating->product->title}}</p>
                                </a>
                            </td>
                            <td>{{$rating->created_at}}</td>
                            <td>
                                <button data-bs-toggle="modal" data-bs-target="#confirmodal" class="mb-2 btn btn-danger rounded-pill text-white fw-bold" onclick="event.stopPropagation();" data-product-id="{{ $rating->id }}">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
        </table>
    </div>
</div>

<div class="modal fade overflow-hidden" id="confirmodal" tabindex="-1" aria-labelledby="confirmodalabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #cfcfcf">
                <h5 class="modal-title text-dark fw-bold" id="confirmodalabel">Confirm delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color:#fffff">
                <strong> Are you sure to delete this review ! </strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                <form id="deleteForm" action="{{ route('deleteRating', 0) }} " method="GET">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        Delete
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const deleteButtons = document.querySelectorAll('[data-bs-target="#confirmodal"]');
    const deleteForm = document.getElementById('deleteForm');

    deleteButtons.forEach(button => {
        button.addEventListener('click', event => {
            const productId = event.target.dataset.productId;
            deleteForm.action = deleteForm.action.replace(/\/\d+$/, `/${productId}`);
        });
    });
</script>


<style>
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
@endsection