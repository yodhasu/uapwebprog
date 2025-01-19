@extends('layout.admin-layout')

@section('content')
<div class="position-absolute top-50 start-50 translate-middle border border-2 rounded border-success border-black w-50">
    <form class="m-3" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="exampleInputText" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="exampleInputText" name="name">
        </div>
        <select class="form-select" aria-label="Default select example" name="category">
            <option selected>Category</option>
            <option value="1">Regular Worker</option>
            <option value="2">Illegal Immigrant</option>
            <option value="3">Criminal</option>
            <option value="4">Field Worker</option>
        </select>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Product Description</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="description"></textarea>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">$</span>
            <input type="text" class="form-control" placeholder="Product Price" name="price">
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Product Image</label>
            <input class="form-control" type="file" id="formFile" name="image" accept="image/*">
        </div>
        <div class="d-grid gap-2">
            <button class="btn btn-primary" type="submit">Add/Update</button>
        </div>
    </form>

</div>
@endsection