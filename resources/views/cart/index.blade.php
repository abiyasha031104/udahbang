@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Shopping Cart</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($cartItems->count() > 0)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartItems as $cart)
            <tr>
                <td>{{ $cart->product->name }}</td>
                <td>
                    <form action="{{ route('cart.update', $cart->product_id) }}" method="POST">
                        @csrf
                        <input type="number" name="quantity" value="{{ $cart->quantity }}" min="1">
                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                    </form>
                </td>
                <td>{{ number_format($cart->price, 2) }}</td>
                <td>{{ number_format($cart->price * $cart->quantity, 2) }}</td>
                <td>
                    <!-- Gunakan GET karena di routes remove masih pakai GET -->
                    <form action="{{ route('cart.remove', $cart->product_id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p>No items in cart</p>
    @endif
</div>
@endsection
