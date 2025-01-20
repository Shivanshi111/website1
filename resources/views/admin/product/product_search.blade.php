<div id="product-container">
<div class="card-body table-responsive p-0" id="product-container">
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th width="60">S.no</th>
                <th width="80"></th>
                <th>Title</th>
                <th>Price</th>
                <th>Qty</th>
                <th>SKU</th>
                <th width="100">Status</th>
                <th width="100">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $product->image) }}" class="img-thumbnail" width="50">
                    </td>
                    <td>{{ $product->title }}</td>
                    <td>${{ $product->price }}</td>
                    <td>{{ $product->qty }} left in Stock</td>
                    <td>{{ $product->sku }}</td>
                    <td>
                        @if($product->status)
                            <svg class="text-success-500 h-6 w-6 text-success" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        @else
                            <svg class="text-danger-500 h-6 w-6 text-danger" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M4.93 4.93a10 10 0 110 14.14A10 10 0 014.93 4.93z"></path>
                            </svg>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}">
                            <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                            </svg>
                        </a>

                        <a href="javascript:void(0);" onclick="return confirmDelete('{{ route('products.destroy', $product->id) }}');" class="text-danger w-4 h-4 mr-1">
                            <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

<script>
    function confirmDelete(url) {
        if (confirm('Are you sure you want to delete this product?')) {
            window.location.href = url;
        } else {
            return false; // Prevent deletion if canceled
        }
    }
</script>
    <div class="d-flex justify-content-center">
        {{ $products->links('vendor.pagination.bootstrap-5') }}
    </div>
</div>

</div>