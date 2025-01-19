<!-- resources/views/home.blade.php -->
@extends('layout.app')

@section('css')
<style>
    .card img {
        width: 200px; /* Set a consistent width */
        height: 200px; /* Set a consistent height */
        object-fit: cover; /* Ensure the image fits properly */
    }
</style>
@endsection

@section('content')
@if(session('warning'))
    <div class="modal fade" id="warningModal" tabindex="-1" aria-labelledby="warningModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="warningModalLabel">Warning</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ session('warning') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        var myModal = new bootstrap.Modal(document.getElementById('warningModal'));
        myModal.show();
    </script>
@endif


<div class="row row-cols-3 position-absolute" style="margin-left: 10%; margin-right:10%; height:0px;">
    @foreach ($products as $product)
        <div class="card align-items-center" style="width:25%;margin: 10px;">
            <img src="{{ asset('storage/' .$product->image) }}" class="card-img-top" alt="Product Image">
            <div class="card-body text-wrap">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text description">{{ $product->description }}</p>
                <p class="card-text">Price: ${{ $product->price }}</p>
                <p>{{$product->product_id}}</p>
                <a href="{{route('products.show', $product->product_id)}}" class="btn btn-primary">View More</a>
            </div>
        </div>
    @endforeach
</div>

<script>
    document.querySelectorAll('.description').forEach(function(el) {
        const words = el.innerText.split(' ');
        if (words.length > 50) {
            el.innerText = words.slice(0, 10).join(' ') + '...';
        }
    });
</script>

    
@endsection
