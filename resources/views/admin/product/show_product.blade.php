<!-- resources/views/admin/product/show_product.blade.php -->
@extends('front.layouts.app')
@section('content')
<div class="container">
    <h1>Product Details</h1>

    <!-- Display product title -->
    <h2>{{ $product->title }}</h2>
    <style>
    .product-image {
        width: 400px;      /* Set the width to a medium size */
        height: auto;      /* Maintain aspect ratio */
        max-width: 100%;   /* Ensures the image doesn't overflow its container */
    }
</style>
    <!-- Display product image -->
    @if($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="img-fluid">
    @else
        <p>No image available</p>
    @endif

    <!-- Display product description -->
    <p><strong>Description:</strong> {{ $product->description }}</p>

    <!-- Display product price and compare price -->
    <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
    @if($product->compare_price > 0)
        <p><strong>Compare Price:</strong> <del>${{ number_format($product->compare_price, 2) }}</del></p>
    @endif

    <!-- Display category, subcategory, and brand -->
    <p><strong>Category:</strong> {{ $product->category->name ?? 'N/A' }}</p>
    <p><strong>Subcategory:</strong> {{ $product->subcategory->name ?? 'N/A' }}</p>
    <p><strong>Brand:</strong> {{ $product->brand->name ?? 'N/A' }}</p>

    <!-- Display other product details -->
    <p><strong>SKU:</strong> {{ $product->sku }}</p>
    <p><strong>Barcode:</strong> {{ $product->barcode }}</p>
    <p><strong>Quantity:</strong> {{ $product->qty }}</p>
    <p><strong>Status:</strong> {{ $product->status ? 'Active' : 'Inactive' }}</p>
    <p><strong>Featured:</strong> {{ $product->featured ? 'Yes' : 'No' }}</p>

    <a href="{{ route('front.home') }}" class="btn btn-primary">Back to Product List</a>
</div>
@endsection
