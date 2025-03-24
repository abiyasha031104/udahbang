@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Product Details</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary btn-sm mb-2" href="{{ route('home') }}">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <strong>Name:</strong> {{ $product->name }}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <strong>Category:</strong> {{ $product->category }}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <strong>Price:</strong> ${{ number_format($product->price, 2) }}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <strong>Stock:</strong> {{ $product->stock }}
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <strong>Details:</strong>
            <p>{{ $product->detail }}</p>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <strong>Status:</strong>
            <span class="badge {{ $product->status == 1 ? 'badge-success' : 'badge-danger' }}">
                {{ $product->status == 1 ? 'Active' : 'Inactive' }}
            </span>
        </div>
    </div>
</div>

<p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>
@endsection
