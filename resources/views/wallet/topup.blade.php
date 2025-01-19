@extends('layout.app')

@section('title', 'Top Up Wallet')

@section('content')
<div class="container mt-4">
    <h2>Top Up Wallet for {{ $wallet->user->name }}</h2>

    <form action="{{ route('wallet.topup.post', $wallet->user_id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Your Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="address">Your Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
        </div>

        <div class="form-group">
            <label for="amount">Amount to Top Up</label>
            <input type="number" class="form-control" id="amount" name="amount" value="{{ old('amount') }}" required min="1">
        </div>

        <button type="submit" class="btn btn-success mt-3">Top Up</button>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@endsection
