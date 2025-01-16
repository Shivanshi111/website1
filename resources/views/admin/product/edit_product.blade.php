@extends('admin.layouts.app')
@section('content')
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Product</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('products.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" value="{{ old('title', $product->title) }}" class="form-control" placeholder="Title">
                                @error('title')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" placeholder="Description">{{ old('description', $product->description) }}</textarea>
                                @error('description')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <label>Current Image:</label>
                            @if($product->image)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" width="150">
                            </div>
                            @endif

                            <div class="mb-3">
                                <label for="image">Upload New Image</label>
                                <input type="file" name="image" id="image" class="form-control">
                                @error('image')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <h2 class="h4 mb-3">Pricing</h2>
                            <div class="mb-3">
                                <label for="price">Price</label>
                                <input type="text" name="price" id="price" value="{{ old('price', $product->price) }}" class="form-control" placeholder="Price">
                                @error('price')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="compare_price">Compare at Price</label>
                                <input type="text" name="compare_price" id="compare_price" value="{{ old('compare_price', $product->compare_price) }}" class="form-control" placeholder="Compare at Price">
                                @error('compare_price')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <h2 class="h4 mb-3">Inventory</h2>
                            <div class="mb-3">
                                <label for="sku">SKU</label>
                                <input type="text" name="sku" id="sku" value="{{ old('sku', $product->sku) }}" class="form-control" placeholder="SKU">
                                @error('sku')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="barcode">Barcode</label>
                                <input type="text" name="barcode" id="barcode" value="{{ old('barcode', $product->barcode) }}" class="form-control" placeholder="Barcode">
                                @error('barcode')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="qty">Quantity</label>
                                <input type="number" name="qty" id="qty" value="{{ old('qty', $product->qty) }}" class="form-control" placeholder="Quantity">
                                @error('qty')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <h2 class="h4 mb-3">Product Details</h2>
                            <div class="mb-3">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="subcategory_id">Subcategory</label>
                                <select name="subcategory_id" id="subcategory_id" class="form-control">
                                    <option value="">Select Subcategory</option>
                                    @foreach($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}" {{ $product->subcategory_id == $subcategory->id ? 'selected' : '' }}>{{ $subcategory->name }}</option>
                                    @endforeach
                                </select>
                                @error('subcategory_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="brand_id">Brand</label>
                                <select name="brand_id" id="brand_id" class="form-control">
                                    <option value="">Select Brand</option>
                                    @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="h4 mb-3">Status</h2>
                            <div class="mb-3">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="featured">Featured</label>
                                <select name="featured" id="featured" class="form-control">
                                    <option value="1" {{ $product->featured == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ $product->featured == 0 ? 'selected' : '' }}>No</option>
                                </select>
                                @error('featured')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                                <div class="mb-3">
                                <label for="featured">Featured</label>
                                <select name="featured" id="featured" class="form-control">
                                    <option value="1" {{ $product->featured == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ $product->featured == 0 ? 'selected' : '' }}>No</option>
                                </select>
                                @error('featured')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3">Update Product</button>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
