@extends('admin.layouts.app')

@section('content')
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Product</h1>
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

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">								
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" class="form-control" placeholder="Title">	
                                    @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" cols="30" rows="10" class="summernote" placeholder="Description"></textarea>
                                    @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>                                            
                        </div>
                    </div>	                                                                      
                </div>
                
                <div class="card mb-3">
    <div class="card-body">
        <h2 class="h4 mb-3">Media</h2>
        <div class="mb-3">
            <label for="image" class="form-label">Upload Image</label>
            <input type="file" name="image" id="image" class="form-control">
            @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
        </div>

        @if(isset($product) && $product->image)
            <div class="mt-3">
                <label>Current Image:</label>
                <div>
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" width="150">
                </div>
            </div>
        @endif
    </div>
</div>


                <div class="card mb-3">
                    <div class="card-body">
                        <h2 class="h4 mb-3">Pricing</h2>								
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="price">Price</label>
                                    <input type="text" name="price" id="price" class="form-control" placeholder="Price">	
                                    @error('price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="compare_price">Compare at Price</label>
                                    <input type="text" name="compare_price" id="compare_price" class="form-control" placeholder="Compare Price">
                                    @error('campare_price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                    <p class="text-muted mt-3">
                                        To show a reduced price, move the product’s original price into Compare at price. Enter a lower value into Price.
                                    </p>	
                                </div>
                            </div>                                            
                        </div>
                    </div>	                                                                      
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <h2 class="h4 mb-3">Inventory</h2>								
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sku">SKU (Stock Keeping Unit)</label>
                                    <input type="text" name="sku" id="sku" class="form-control" placeholder="sku">	
                                    @error('sku')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="barcode">Barcode</label>
                                    <input type="text" name="barcode" id="barcode" class="form-control" placeholder="Barcode">	
                                    @error('barcode')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>   
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="track_qty" name="track_qty" checked>
                                        <label for="track_qty" class="custom-control-label">Track Quantity</label>
                                        @error('track_qty')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input type="number" min="0" name="qty" id="qty" class="form-control" placeholder="Qty">
                                    @error('qty')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror	
                                </div>
                            </div>                                         
                        </div>
                    </div>	                                                                      
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">	
                        <h2 class="h4 mb-3">Product Status</h2>
                        <div class="mb-3">
                        <select name="status" id="status" class="form-control">
                                    <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Blocked</option>
                                </select>
                        </div>
                    </div>
                </div> 

                <div class="card mb-3">
                    <div class="card-body">	
                        <h2 class="h4 mb-3">Product Category</h2>
                        <div class="mb-3">
                            <label for="category">Category</label>
                            <select name="category_id" id="categories_id" class="form-control">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sub_category">Sub Category</label>
                            <select name="subcategory_id" id="subcategories_id" class="form-control">
                                <option value="">Select Subcategory</option>
                                @foreach($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                @endforeach
                            </select>
                            @error('subcategory_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                </div> 

                <div class="card mb-3">
                    <div class="card-body">	
                        <h2 class="h4 mb-3">Product Brand</h2>
                        <div class="mb-3">
                            <select name="brand_id" id="brands_id" class="form-control">
                                <option value="">Select Brand</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                </div> 

                <div class="card mb-3">
                    <div class="card-body">	
                        <h2 class="h4 mb-3">Featured Product</h2>
                        <div class="mb-3">
                            <select name="featured" id="featured" class="form-control">
                                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>No</option>
                                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Yes</option>                                                 
                            </select>
                            @error('featured')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                </div>                                 
            </div>
        </div>

        <div class="pb-5 pt-3">
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('products.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>
        </form>
    </div>
</section>

@endsection

