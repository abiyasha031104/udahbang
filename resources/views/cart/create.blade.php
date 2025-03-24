@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Add to Cart</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Add a product to your shopping cart.
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form action="{{ route('carts.store') }}" method="POST">
                    @csrf
                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                            @if ($errors->any())
                                <div class="rounded-md bg-red-50 p-4">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-red-800">There were errors with your submission</h3>
                                            <div class="mt-2 text-sm text-red-700">
                                                <ul class="list-disc pl-5 space-y-1">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="col-span-6 sm:col-span-3">
                                <label for="product_id" class="block text-sm font-medium text-gray-700">Product</label>
                                <select id="product_id" name="product_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="">Select a product</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }} - ${{ number_format($product->price, 2) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <button type="button" id="quantity-decrease" class="inline-flex items-center px-3 py-2 border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm rounded-l-md hover:bg-gray-100">
                                        -
                                    </button>
                                    <input type="number" name="quantity" id="quantity" value="1" min="1" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full py-2 px-3 sm:text-sm border-gray-300 text-center">
                                    <button type="button" id="quantity-increase" class="inline-flex items-center px-3 py-2 border border-l-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm rounded-r-md hover:bg-gray-100">
                                        +
                                    </button>
                                </div>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label class="block text-sm font-medium text-gray-700">Price</label>
                                <div class="mt-1 text-lg font-medium text-gray-900" id="product-price">$0.00</div>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label class="block text-sm font-medium text-gray-700">Subtotal</label>
                                <div class="mt-1 text-lg font-medium text-gray-900" id="subtotal">$0.00</div>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <a href="{{ route('products.index') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Cancel
                            </a>
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const productSelect = document.getElementById('product_id');
        const quantityInput = document.getElementById('quantity');
        const decreaseButton = document.getElementById('quantity-decrease');
        const increaseButton = document.getElementById('quantity-increase');
        const priceDisplay = document.getElementById('product-price');
        const subtotalDisplay = document.getElementById('subtotal');
        
        // Function to update price and subtotal
        function updatePriceAndSubtotal() {
            const selectedOption = productSelect.options[productSelect.selectedIndex];
            const price = selectedOption && selectedOption.dataset.price ? parseFloat(selectedOption.dataset.price) : 0;
            const quantity = parseInt(quantityInput.value) || 1;
            
            priceDisplay.textContent = '$' + price.toFixed(2);
            subtotalDisplay.textContent = '$' + (price * quantity).toFixed(2);
        }
        
        // Event listeners
        productSelect.addEventListener('change', updatePriceAndSubtotal);
        quantityInput.addEventListener('input', updatePriceAndSubtotal);
        
        decreaseButton.addEventListener('click', function() {
            if (quantityInput.value > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
                updatePriceAndSubtotal();
            }
        });
        
        increaseButton.addEventListener('click', function() {
            quantityInput.value = parseInt(quantityInput.value) + 1;
            updatePriceAndSubtotal();
        });
        
        // Initialize
        updatePriceAndSubtotal();
    });
</script>
@endsection