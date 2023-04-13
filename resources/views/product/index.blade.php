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
    <div class="w-75 text-end mb-3">
        <a class="btn btn-primary px-5" href="{{route('productCreate')}}"><i class="bi bi-plus"></i>Add</a>
    </div>

    <div class="container-fluid table-responsive" >
        <table class="table table-bordered border-dark">
                <thead>
                    <tr>
                        <th class="col">Title</th>
                        <th scope="col">Fish Type</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Date of Fishing</th>
                        <th scope="col">Description</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        @if($product->fisher_id == Session::get('user')->id)
                            <tr onclick="location.href='{{ route('productEdit', $product->id) }}';" style="cursor: pointer;">
                                <td>{{ Str::limit($product->title, 25, '...') }}</td>
                                <td>{{ Str::limit($product->fish_type, 50, '...') }}</td>
                                <td><img src="{{asset('products-img/')}}/{{ $product->photo }}" alt="{{ $product->title }}" width="150px" height="auto"></td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->date_of_fishing }}</td>
                                <td>{{ Str::limit($product->description, 25, '...') }}</td>
                                {{-- should not be included in click --}}
                                <td>
                                    <button data-bs-toggle="modal" data-bs-target="#confirmodal" class="mb-2 btn btn-danger rounded-pill text-white fw-bold" onclick="event.stopPropagation();" data-product-id="{{ $product->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @endif
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
                <strong> Are you sure to delete this product ! </strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                <form id="deleteForm" action="{{ route('product.destroy', 0) }} " method="POST">
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

@endsection
