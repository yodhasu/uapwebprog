@extends('layout.app')

@section('title', 'Checkout')

@section('content')
<div class="container mt-4">
    <h2>Checkout</h2>

    <!-- Cart Items Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Amount</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach ($cartItems as $item)
                @php $subtotal = $item['price'] * $item['quantity']; @endphp
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>${{ number_format($item['price'], 2) }}</td>
                    <td>${{ number_format($subtotal, 2) }}</td>
                </tr>
                @php $total += $subtotal; @endphp
            @endforeach
        </tbody>
    </table>

    <!-- Total -->
    <h4>Total: ${{ number_format($total, 2) }}</h4>
    <h5>Your Wallet Balance: ${{ number_format($wallet->balance, 2) }}</h5>
    <h5>Your Point: {{ number_format($wallet->points, 2) }}</h5>
    <h5>Price After Point DIscount: {{ number_format( max($total - $wallet->points, 0), 2) }}</h5>

    @if ($wallet->balance >= $total)
        <p class="text-success">You have enough balance to pay for your items.</p>
    @else
        <p class="text-danger">Insufficient balance in your wallet. Please top up.</p>
    @endif

    <!-- Checkout Form -->
    <form action="{{ route('paytheblackman') }}" method="POST" class="mt-3">
        @csrf
        <input type="hidden" name="total" value="{{ $total }}">
        <input type="hidden" id="use_points" name="use_points" value= 0>
        
        @if ($wallet->balance >= $total)
            <script>
                console.log("Pay nigga")
            </script>
            <button type="submit" class="btn btn-primary">Pay Now</button>
        @else
            <button type="button" class="btn btn-secondary" disabled>Insufficient Balance</button>
        @endif
        <button type="submit" class="btn btn-primary" 
            onclick="document.getElementById('use_points').value = 1; return true;">
            Use All Points
        </button>
    </form>
</div>
@endsection
