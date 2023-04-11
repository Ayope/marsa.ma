@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center align-items-center mt-3" style="height: 50vh;">
      <div class="col-md-9 col-lg-6">
        <h2 class='text-center'>Add new product</h2>
        <form action="{{ route('create.product') }}" method="POST" enctype="multipart/form-data" class="p-3 rounded" style="background-color: #f2f2f2;">
          @csrf

          @if(Session::has('success'))
          <div class="alert alert-success">{{Session::get('success')}}</div>
          @endif

          @if(Session::has('fail'))
              <div class="alert alert-danger">{{Session::get('fail')}}</div>
          @endif

          <input type="hidden" name="fisher_id" value="{{Session::get('user')->id}}">

          <div class="form-group mb-3">
            <label for="title">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ old('title') }}">
            @error('title')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group mb-3">
            <label for="fish_type">Fish Type</label>
            <input type="text" class="form-control @error('fish_type') is-invalid @enderror" name="fish_type" id="fish_type" value="{{ old('fish_type') }}">
            @error('fish_type')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group mb-3">
            <label for="photo">Photo</label>
            <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" id="photo">
            @error('photo')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group mb-3">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" id="quantity" value="{{ old('quantity') }}">
            @error('quantity')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group mb-3">
            <label for="price">Price</label>
            <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" id="price" value="{{ old('price') }}">
            @error('price')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group mb-3">
            <label for="date_of_fishing">Date of Fishing</label>
            <input type="date" class="form-control @error('date_of_fishing') is-invalid @enderror" name="date_of_fishing" id="date_of_fishing" value="{{ old('date_of_fishing') }}">
            @error('date_of_fishing')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="5">{{ old('description') }}</textarea>
            @error('description')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>

          <button type="submit" class="btn btn-primary mb-3 w-100">Submit</button>
        </form>
      </div>
    </div>
  </div>
@endsection
