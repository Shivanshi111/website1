@extends('front.layouts.app')
@section('content')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Home</a></li>
                <li class="breadcrumb-item active">Shop</li>
            </ol>
        </div>
    </div>
</section>

<section class="section-6 pt-5">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 sidebar">
                <div class="sub-title">
                    <h2>{{ __('messages.Categories') }}</h2>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="accordion accordion-flush" id="accordionExample">
                            @if($categories->isNotEmpty())
                                @foreach($categories as $key => $category)
                                    <div class="accordion-item">
                                        @if($category->subcategories->isNotEmpty())
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne-{{$key}}" aria-expanded="false"
                                                    aria-controls="collapseOne-{{$key}}">
                                                    {{ $category->translations->firstWhere('locale', app()->getLocale()) ? $category->translations->firstWhere('locale', app()->getLocale())->name : $category->name }}
                                                </button>
                                            </h2>
                                        @else
                                            <a href="{{ route('front.shop', $category->slug) }}"+
                                                class="nav-item nav-link">{{ $category->name }}</a>
                                        @endif
                                        @if($category->subcategories->isNotEmpty())
                                            <div id="collapseOne-{{$key}}" class="accordion-collapse collapse"
                                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="navbar-nav">
                                                        @foreach($category->subcategories as $subCategory)
                                                            <a href="{{ route('front.shop', ['categorySlug' => $category->slug, 'subCategorySlug' => $subCategory->slug]) }}"
                                                                class="nav-item nav-link">
                                                                {{ $subCategory->getTranslatedNameAttribute() }}
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <!-- Brand Filter -->
                <div class="sub-title mt-5">
    <h2>{{ __('messages.Brand') }}</h2>
</div>
<div class="card">
    <div class="card-body">
        @if($brands->isNotEmpty())
            @foreach($brands as $brand)
                <div class="form-check mb-2">
                    <input 
                        {{ in_array($brand->id, $brandsArray) ? 'checked' : '' }} 
                        class="form-check-input brand-label" 
                        type="checkbox" 
                        name="brand[]" 
                        value="{{ $brand->id }}" 
                        id="brand-{{ $brand->id }}">
                    <label class="form-check-label" for="brand-{{ $brand->id }}">
                        {{-- Fetch the translated name based on the locale --}}
                        {{ $brand->translations->firstWhere('locale', app()->getLocale())?->name ?? $brand->name }}
                    </label>
                </div>
            @endforeach
        @endif
    </div>
</div>


                <!-- Price Filter -->
                <div class="sub-title mt-5">
                    <h2>{{__('messages.Price')}}</h2>
                </div>
                <div class="card">
                    <div class="card-body">
                    <input type="text" class="js-range-slider" name="my_range" value="" />
                    </div>
                </div>
            </div>

            <!-- Product List -->
            <div class="col-md-9">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-end mb-4">
                            <div class="ml-2">
                            <select name="sort" id="sort" class="form-control">
    <option value="latest" {{ $sort == 'latest' ? 'selected' : '' }}>{{__('messages.Latest')}}</option>
    <option value="price_desc" {{ $sort == 'price_desc' ? 'selected' : '' }}>{{__('messages.Price High')}}</option>
    <option value="price_asc" {{ $sort == 'price_asc' ? 'selected' : '' }}>{{__('messages.Price Low')}}</option>
</select>
                            </div>
                        </div>
                    </div>

                    @if($products->isNotEmpty())
                   
                        @foreach($products as $product)
                            <div class="col-md-4">
                                <div class="card product-card">
                                    <div class="product-image position-relative">
                                        @if($product->image != "")
                                            <a href="{{ route('products.show', $product->slug) }}" class="product-img"><img class="card-img-top"
                                                    src="{{ asset('storage/'.$product->image) }}" alt=""></a>
                                        @endif
                                        <a class="whishlist" href="#"><i class="far fa-heart"></i></a>
                                        <div class="product-action">
                                            <a class="btn btn-dark" href="#">
                                                <i class="fa fa-shopping-cart"></i> {{ __('messages.ADD TO CART') }}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body text-center mt-3">
                                        <a class="h6 link" href="#">{{ $product->translatedName }}</a>
                                        <div class="price mt-2">
                                            <span class="h5"><strong>${{$product->price}}</strong></span>
                                            @if($product->compare_price > 0)
                                                <span class="h6 text-underline"><del>${{$product->compare_price}}</del></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center">{{__('messages.No products found.')}}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customJs')
<script>
    // Initialize the range slider
    var rangeSlider = $(".js-range-slider").ionRangeSlider({
        type: "double",
        min: 0,
        max: 1000,
        from: {{$priceMin}},
        step: 10,
        to: {{$priceMax}},
        skin: "round",
        max_postfix: "+",
        prefix: "$",
        onFinish: function () {
            apply_filter() // Apply filter on slider change
        },
    });

    var slider = $(".js-range-slider").data("ionRangeSlider");

    // Trigger filter on brand selection
    $(".brand-label").change(function () {
        apply_filter();
    });

    $("#sort").change(function(){
        apply_filter();
    });

    // Function to build URL and redirect
    function apply_filter() {
        var brands = [];
        $(".brand-label:checked").each(function () {
            brands.push($(this).val());
        });

        // Generate URL with query parameters
        var url = '{{ url()->current() }}';
        var params = [];

        // Add brand filter
        if (brands.length > 0) {
            params.push('brand=' + brands.join(','));
        }

        // Add price range filter
        params.push('price_min=' + slider.result.from);
        params.push('price_max=' + slider.result.to);

        // Redirect to the filtered URL
        params.push('sort=' + $("#sort").val())
        window.location.href = url + '?' + params.join('&');
    }
</script>
@endsection