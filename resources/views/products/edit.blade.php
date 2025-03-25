@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Product</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary btn-sm mb-2" href="{{ route('products.index') }}">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('products.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control" placeholder="Enter product name" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <strong>Category:</strong>
                <input type="text" name="category" value="{{ old('category', $product->category) }}" class="form-control" placeholder="Enter product category" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <strong>Price:</strong>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" class="form-control" placeholder="Enter product price" step="0.01" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <strong>Stock:</strong>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="form-control" placeholder="Enter available stock" required>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <strong>Detail:</strong>
                <textarea class="form-control" style="height:150px" name="detail" placeholder="Enter product details">{{ old('detail', $product->detail) }}</textarea>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <strong>Status:</strong>
                <select name="status" class="form-control">
                    <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>

        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-primary btn-sm mb-2 mt-2">
                <i class="fa-solid fa-floppy-disk"></i> Submit
            </button>
        </div>
    </div>
</form>

<p class="text-center text-primary"><small>Powered by Larisin Aja Mart</small></p>
@endsection
