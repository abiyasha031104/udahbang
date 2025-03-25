@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Product</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary btn-sm" href="{{ route('products.index') }}">
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

<form action="{{ route('products.store') }}" method="POST">
    @csrf

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="Enter product name" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <strong>Category:</strong>
                <input type="text" name="category" class="form-control" placeholder="Enter product category" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <strong>Price:</strong>
                <input type="number" name="price" class="form-control" placeholder="Enter product price" step="0.01" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <strong>Stock:</strong>
                <input type="number" name="stock" class="form-control" placeholder="Enter available stock" required>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <strong>Detail:</strong>
                <textarea class="form-control" style="height:150px" name="detail" placeholder="Enter product details"></textarea>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <strong>Status:</strong>
                <select name="status" class="form-control">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
        </div>

        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-primary btn-sm mb-3 mt-2">
                <i class="fa-solid fa-floppy-disk"></i> Submit
            </button>
        </div>
    </div>
</form>

<p class="text-center text-primary"><small>Powered by Larisin Aja Mart</small></p>
@endsection
