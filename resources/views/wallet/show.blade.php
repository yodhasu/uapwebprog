@extends('layout.app')

@section('title', 'Wallet')

@section('content')
<div class="container mt-4">
    <h2>Wallet for {{ $wallet->user->name }}</h2>
    <p>Address: {{ $wallet->address }}</p>
    <p>Current Balance: ${{ number_format($wallet->balance, 2) }}</p>
    <p>Points: {{ number_format($wallet->points, 2) }}</p>

    <!-- Top-up Button -->
    <a href="{{ route('wallet.topup', $wallet->user_id) }}" class="btn btn-primary">Top Up Wallet</a>
</div>
@endsection
