@extends('layouts.app')

@section('content')

<div class="container d-flex justify-content-center mt-3 align-items-center">
    <div class="table-responsive" >
        <table class="table">
                <thead>
                    <tr>
                        <th >Title</th>
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
                        {{-- <tr data-href="{{ route('products.edit', $product->id) }}"> --}}
                        <tr>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->fish_type }}</td>
                            <td><img src="{{asset('products-img/')}}/{{ $product->photo }}" alt="{{ $product->title }}" width="150px" height="auto"></td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->date_of_fishing }}</td>
                            <td>{{ Str::limit($product->description, 50, '...') }}</td>
                            <td>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $product->id }}">
                                    <i class="fa fa-trash"></i> Delete
                                </button>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $product->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $product->id }}">Confirm Delete</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete "{{ $product->title }}"?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
        </table>
    </div>
</div>


@endsection
