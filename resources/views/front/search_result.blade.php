@extends('layouts.front')

@section('content')
<div class="container mt-5">
    <h1>Search Results for "{{ $query }}"</h1>

    @if($products->isEmpty() && $categories->isEmpty() && $brands->isEmpty())
        <p>No results found.</p>
    @else
        <div class="mt-4">
            <h3>Products</h3>
            <ul>
                @forelse($products as $product)
                    <li><a href="{{ route('product.details', $product->id) }}">{{ $product->name }}</a></li>
                @empty
                    <p>No products found.</p>
                @endforelse
            </ul>
        </div>

        <div class="mt-4">
            <h3>Categories</h3>
            <ul>
                @forelse($categories as $category)
                    <li><a href="{{ route('category.products', $category->id) }}">{{ $category->name }}</a></li>
                @empty
                    <p>No categories found.</p>
                @endforelse
            </ul>
        </div>

        <div class="mt-4">
            <h3>Brands</h3>
            <ul>
                @forelse($brands as $brand)
                    <li><a href="{{ route('brand.products', $brand->id) }}">{{ $brand->name }}</a></li>
                @empty
                    <p>No brands found.</p>
                @endforelse
            </ul>
        </div>
    @endif
</div>
@endsection
