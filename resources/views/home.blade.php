@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h4 class="mb-3">Produk Terbaru</h4>
                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $product->name }}</h5>
                                        <p class="card-text">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">Lihat Detail</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <a href="{{ route('products.index') }}" class="btn btn-link">Lihat Semua Produk</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
