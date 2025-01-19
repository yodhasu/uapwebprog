<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Display the cart page
    public function index()
    {
        $cart = session()->get('cart', []);

        return view('cart.show', compact('cart'));
    }

    // Add product to the cart
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Retrieve the cart from session or initialize it if it's empty
        $cart = session()->get('cart', []);

        // If the product is already in the cart, increase the quantity
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $request->quantity;
        } else {
            // Add product to cart with its name and quantity
            $cart[$id] = [
                'name' => $product->name,
                'quantity' => $request->quantity,
                'price' => $product->price * $request->quantity,
            ];
        }

        // Save cart back to the session
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    // Remove product from the cart
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        // Remove the item from the cart
        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        // Save the updated cart back to the session
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Product removed from cart!');
    }

    // Update quantity of a product in the cart
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        $product = Product::findOrFail($id);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            $cart[$id]['price'] = $product->price * $cart[$id]['quantity'];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Cart updated!');
    }
    public function checkout(Request $request)
    {
        $user = Auth::user();
        $wallet = Wallet::where('user_id', $user->id)->first();
        $usePoints = $request->input('use_points');
        $total = $request->input('total');
        
        if ($wallet->balance + $wallet->points >= $total and $usePoints) {
            // Deduct total from wallet
            $total -= $wallet->points;
            $wallet->points =0;
            $wallet->balance -= $total;
            $wallet->save();
    
            // Clear the cart (if using session-based cart)
            session()->forget('cart');
    
            return redirect('/cart')->with('success', 'Payment successful! Your wallet has been charged.');
        }

        if ($wallet->balance >= $total) {
            // Deduct total from wallet
            $wallet->balance -= $total;
            $wallet->points += $total/10;
            $wallet->save();
    
            // Clear the cart (if using session-based cart)
            session()->forget('cart');
    
            return redirect('/cart')->with('success', 'Payment successful! Your wallet has been charged.');
        } else {
            return view('cart.index')->with('error', 'Insufficient wallet balance.');
        }
    }
    public function checkoutView()
    {
        $cartItems = session('cart', []); // Get cart items from session
        $wallet = Wallet::where('user_id', Auth::id())->first();

        return view('cart.checkout', compact('cartItems', 'wallet'));
    }

}
