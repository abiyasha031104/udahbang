@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Cart Item Details</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Item #{{ $cartItem->id }}</p>
                </div>
                <a href="{{ route('carts.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Back to Cart
                </a>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Product Name</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $cartItem->product->name }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Description</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $cartItem->product->detail }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Price</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ number_format($cartItem->product->price, 2) }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Quantity</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <form action="{{ route('carts.update', $cartItem->id) }}" method="POST" class="flex items-center">
                                @csrf
                                @method('PUT')
                                <div class="flex rounded-md shadow-sm">
                                    <button type="button" class="quantity-decrease inline-flex items-center px-3 py-1 border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm rounded-l-md hover:bg-gray-100">
                                        -
                                    </button>
                                    <input type="number" name="quantity" value="{{ $cartItem->quantity }}" min="1" class="quantity-input focus:ring-indigo-500 focus:border-indigo-500 block w-16 pl-3 pr-2 py-1 text-center sm:text-sm border-gray-300">
                                    <button type="button" class="quantity-increase inline-flex items-center px-3 py-1 border border-l-0 border-gray-300 bg-gray-50 text-gray-500 text-sm rounded-r-md hover:bg-gray-100">
                                        +
                                    </button>
                                </div>
                                <button type="submit" class="ml-2 inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Update
                                </button>
                            </form>
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Subtotal</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ number_format($cartItem->product->price * $cartItem->quantity, 2) }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Category</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $cartItem->product->category }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Added to Cart</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $cartItem->created_at->format('M d, Y H:i') }}</dd>
                    </div>
                </dl>
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                <form action="{{ route('carts.destroy', $cartItem->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" onclick="return confirm('Are you sure you want to remove this item?')">
                        Remove from Cart
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Quantity increase/decrease functionality
        const decreaseButton = document.querySelector('.quantity-decrease');
        const increaseButton = document.querySelector('.quantity-increase');
        const quantityInput = document.querySelector('.quantity-input');

        decreaseButton.addEventListener('click', function() {
            if (quantityInput.value > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
            }
        });

        increaseButton.addEventListener('click', function() {
            quantityInput.value = parseInt(quantityInput.value) + 1;
        });
    });
</script>
@endsection