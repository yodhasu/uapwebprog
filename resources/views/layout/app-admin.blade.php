<!-- resources/views/layout/app.blade.php -->
@include('layout.admin-layout') <!-- Include your navbar -->

@section('css')
<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
@endsection

@section('script')
<script src="{{ asset('js/bootstrap.js') }}"></script>
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Layout</title>
    @yield('css')
</head>
<body>
    <div class=>
        @yield('content') <!-- Page-specific content goes here -->
    </div>
    @yield('script')
</body>
</html>
