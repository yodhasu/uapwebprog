@extends('layout.app')

@section('title', 'Product Details')

@section('content')
<div class="container mt-4">
    <div class="row">
        <!-- Product Image Section -->
        <div class="col-md-6">
            <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid" alt="Product Image">
        </div>

        <!-- Product Details Section -->
        <div class="col-md-6">
            <h2>{{ $product->name }}</h2>
            <p class="text-muted">{{ $product->category }}</p>
            <h3 class="text-success">${{ number_format($product->price, 2) }}</h3>
            <p>{{ $product->description }}</p>

            <!-- Add to Cart and Buy Now Buttons -->
            <div class="mt-3">
                <form action="{{ route('cart.add', $product->product_id) }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" name="quantity" value="1" min="1" max="99">
                        <button class="btn btn-primary" type="submit">Add to Cart</button>
                    </div>
                </form>
                <button class="btn btn-warning">Buy Now</button>
            </div>
        </div>
    </div>
</div>
@endsection
