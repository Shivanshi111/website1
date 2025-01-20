@extends('admin.layouts.app')
@section('content')
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Products</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('products.create') }}" class="btn btn-primary">New Product</a>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <form method="GET" action="{{ route('products.search') }}" id="search-form">
                        <div class="input-group" style="width: 250px;">
                            <input type="text" name="query" class="form-control float-right" placeholder="Search" value="{{ request('query') }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

           
            <div class="card-body table-responsive p-0" id="product-container">
                <!-- Include the product search view here -->
                @include('admin.product.product_search', ['products' => $products])
            </div>
              

              
            </div>
        </div>
    </div>
</section>

@yield('customJs')
<script>
    // Setup CSRF token for AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'X-Requested-With': 'XMLHttpRequest' // This ensures it's recognized as an AJAX request
        }
    });

    // Handle AJAX request for search
    $('#search-form').on('submit', function(e) {
        e.preventDefault();  // Prevent the default form submission

        const query = $('input[name="query"]').val();  // Capture the input value

        $.ajax({
            url: "{{ route('products.search') }}",
            method: "GET",
            data: { query: query },
            success: function(response) {
                // Update the product list in the container with the response
                $('#product-container').html(response.html);
            },
            error: function(error) {
                console.error(error);
            }
        });
    });
</script>
@endsection

