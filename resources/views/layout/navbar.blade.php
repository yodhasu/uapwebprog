<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nigger Auction</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css')}}">
    <!-- <link rel="stylesheet" href="{{ asset('css/misc.css')}}"> -->
    <script href="{{ asset('js.bootstrap.js')}}"></script>
</head>
<body>
    <header>
        <nav class="sticky-top navbar navbar-expand-lg bg-body-tertiary ps-5 pe-5" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('home')}}">NiggerAuction</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('home')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('wallet.show', Auth::user()->id )}}">Wallet</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/cart">Cart</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                        </li>
                    </ul>
                </div>
                <form class="d-flex" role="search" method="GET" action="{{ route('products.search') }}">
                    <input class="form-control me-2" type="search" name="name" placeholder="Search by Product Name" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <div class="ps-5">
                    <form action="{{ route('logout')}}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-light">Log Out</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>
</body>
</html>