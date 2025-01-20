@extends('admin.layouts.app')
@section('content')
@if(session('success'))                        
<div class="alert alert-fill alert-success alert-dismissible alert-icon" role="alert">
{{ session('success') }} <button class="close" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-fill alert-success alert-dismissible alert-icon" role="alert">
                {{ session('error') }} <button class="close" data-bs-dismiss="alert"></button>
            </div>
        @endif
<section class="content-header">					
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Categories</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="{{route('categories.create')}}" class="btn btn-primary">New Category</a>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
					<div class="container-fluid">
						<div class="card">
							<div class="card-header">
							<div class="card-tools">
							<form id="search-form" method="GET" action="{{ route('category.search') }}">
    <div class="input-group input-group" style="width: 250px;">
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
							<div class="card-body table-responsive p-0">								
							@include('admin.category.category_search', ['categories' => $category])		
							</div>
							
						</div>
					</div>
					<!-- /.card -->
				</section>
@yield('customJs')
<script>
    // Setup CSRF token for AJAX requests
   // Setup CSRF token for AJAX requests
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        'X-Requested-With': 'XMLHttpRequest' // Ensures it's recognized as an AJAX request
    }
});

// Handle AJAX request for search
$('#search-form').on('submit', function(e) {
    e.preventDefault();  // Prevent the default form submission

    const query = $('input[name="query"]').val();  // Capture the input value

    $.ajax({
        url: "{{ route('category.search') }}",
        method: "GET",
        data: { query: query },
        success: function(response) {
            // Update the product list in the container with the response
            $('#category-container').html(response.html);
        },
        error: function(error) {
            console.error(error);
        }
    });
});
</script>
@endsection



