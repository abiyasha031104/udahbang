<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        return view('cart.index', compact('cartItems'));
    }

    
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($product->stock < 1) {
            return redirect()->back()->with('error', 'Stock not available!');
        }

        $cart = Cart::where('user_id', Auth::id())->where('product_id', $id)->first();

        if ($cart) {
            if ($product->stock < $cart->quantity + 1) {
                return redirect()->back()->with('error', 'Not enough stock!');
            }
            $cart->increment('quantity');
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $id,
                'quantity' => 1,
                'price' => $product->price,
            ]);
        }

        $product->decrement('stock');

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    
    public function updateCart(Request $request, $id)
    {
        $cart = Cart::where('user_id', Auth::id())->where('product_id', $id)->firstOrFail();
        $product = Product::findOrFail($id);

        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $newQuantity = $request->quantity;
        $difference = $newQuantity - $cart->quantity;

        if ($newQuantity > $product->stock + $cart->quantity) {
            return redirect()->back()->with('error', 'Not enough stock available!');
        }

        $cart->update(['quantity' => $newQuantity]);

        if ($difference > 0) {
            $product->decrement('stock', $difference);
        } else {
            $product->increment('stock', abs($difference));
        }

        return redirect()->route('cart.index')->with('success', 'Cart updated!');
    }

    
    public function removeFromCart($id)
    {
        $cart = Cart::where('user_id', Auth::id())->where('product_id', $id)->first();

        if ($cart) {
            Product::where('id', $id)->increment('stock', $cart->quantity);
            $cart->delete();
        }

        return redirect()->route('cart.index')->with('success', 'Product removed from cart!');
    }
}
