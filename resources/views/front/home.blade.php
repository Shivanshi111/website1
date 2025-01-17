@extends('front.layouts.app')
@section('content')
@if(session('success'))
         <div class="alert alert-success text-center">
            {{ session('success') }}
</div>
@endif

@if(session('error'))
    <div class="alert alert-danger text-center">
        {{ session('error') }}
    </div>
@endif
        <section class="section-1">
            <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel"
                data-bs-interval="false">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="images/carousel-1.jpg" class="d-block w-100" alt="">

                        <picture>
                            <source media="(max-width: 799px)"
                                srcset="{{ asset('front-assets/images/carousel-1-m.jpg')}}" />
                            <source media="(min-width: 800px)"
                                srcset="{{ asset('front-assets/images/carousel-1.jpg')}}" />
                            <img src="{{ asset('front-assets/images/carousel-1.jpg')}}" alt="" />
                        </picture>

                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3">
                                <h1 class="display-4 text-white mb-3">{{ __('messages.Kids Fashion') }}</h1>
                                <p class="mx-md-5 px-5">{{ __('messages.Lorem rebum magna amet lorem magna erat diam stet. Sadips duo
                                    stet amet amet ndiam elitr ipsum diam') }}</p>
                                <a class="btn btn-outline-light py-2 px-4 mt-3" href="#">{{ __('messages.Shop Now') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">

                        <picture>
                            <source media="(max-width: 799px)"
                                srcset="{{ asset('front-assets/images/carousel-2-m.jpg')}}" />
                            <source media="(min-width: 800px)"
                                srcset="{{ asset('front-assets/images/carousel-2.jpg')}}" />
                            <img src="{{ asset('front-assets/images/carousel-2.jpg')}}" alt="" />
                        </picture>

                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3">
                                <h1 class="display-4 text-white mb-3">{{ __('messages.Womens Fashion') }}</h1>
                                <p class="mx-md-5 px-5">{{ __('messages.Lorem rebum magna amet lorem magna erat diam stet. Sadips duo
                                    stet amet amet ndiam elitr ipsum diam') }}</p>
                                <a class="btn btn-outline-light py-2 px-4 mt-3" href="#">{{ __('messages.Shop Now') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="images/carousel-3.jpg" class="d-block w-100" alt="">

                        <picture>
                            <source media="(max-width: 799px)"
                                srcset="{{ asset('front-assets/images/carousel-3-m.jpg')}}" />
                            <source media="(min-width: 800px)"
                                srcset="{{ asset('front-assets/images/carousel-3.jpg')}}" />
                            <img src="{{ asset('front-assets/images/carousel-2.jpg')}}" alt="" />
                        </picture>

                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3">
                                <h1 class="display-4 text-white mb-3">{{ __('messages.Shop Online at Flat 70% off on Branded Clothes') }}
                                </h1>
                                <p class="mx-md-5 px-5">{{ __('messages.Lorem rebum magna amet lorem magna erat diam stet. Sadips duo
                                    stet amet amet ndiam elitr ipsum diam') }}</p>
                                <a class="btn btn-outline-light py-2 px-4 mt-3" href="#">{{ __('messages.Shop Now') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>
        <br>
        </br>
        <section class="section-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="box shadow-lg">
                            <div class="fa icon fa-check text-primary m-0 mr-3"></div>
                            <h2 class="font-weight-semi-bold m-0">{{ __('messages.Quality Product') }}</h5>
                        </div>
                    </div>
                    <div class="col-lg-3 ">
                        <div class="box shadow-lg">
                            <div class="fa icon fa-shipping-fast text-primary m-0 mr-3"></div>
                            <h2 class="font-weight-semi-bold m-0">{{ __('messages.Free Shipping') }}</h2>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="box shadow-lg">
                            <div class="fa icon fa-exchange-alt text-primary m-0 mr-3"></div>
                            <h2 class="font-weight-semi-bold m-0">{{ __('messages.14-Day Return') }}</h2>
                        </div>
                    </div>
                    <div class="col-lg-3 ">
                        <div class="box shadow-lg">
                            <div class="fa icon fa-phone-volume text-primary m-0 mr-3"></div>
                            <h2 class="font-weight-semi-bold m-0">{{ __('messages.24/7 Support') }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <br>
        </br>
        <section class="section-3">
            <div class="container">
                <div class="section-title">
                    <h2>{{ __('messages.Categories') }}</h2>
                </div>
                <div class="row pb-3">
                    @if(getCategories()->isNotEmpty())
                    @foreach(getCategories() as $category)
                    <div class="col-lg-3">
                        <div class="cat-card">
                            <div class="left">
                            @if($category->image != "")
                               <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="img-fluid cat-image">

                                @endif
                            </div>
                            <div class="right">
                                <div class="cat-data">
                                    <h2> {{ $category->translations->firstWhere('locale', app()->getLocale()) ? $category->translations->firstWhere('locale', app()->getLocale())->name : $category->name }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </section>

        <!-- Add your CSS directly inside a <style> tag -->
        <style>
        .cat-image {
            width: 100%;
            /* Ensures the image takes full width of its container */
            height: 200px;
            /* Sets a fixed height */
            object-fit: contain;
            /* Ensures the aspect ratio is maintained while filling the container */
            border-radius: 8px;
            /* Optional: Adds rounded corners */
        }

        .cat-card {
            overflow: hidden;
            /* Ensures the card doesn’t overflow */
            background: #f8f9fa;
            /* Optional: Adds a background color for the card */
            border: 1px solid #ddd;
            /* Optional: Adds a border to the card */
            border-radius: 8px;
            /* Optional: Makes the card corners rounded */
            padding: 10px;
            /* Optional: Adds padding inside the card */
            margin-bottom: 15px;
            /* Optional: Adds spacing between cards */
            text-align: center;
            /* Optional: Centers the text */
        }
        </style>



        <section class="section-4 pt-5">
            <div class="container">
                <div class="section-title">
                    <h2>{{ __('messages.Featured Products') }}</h2>
                </div>
                <div class="row pb-3">
                    @if($featuredProducts->isNotEmpty())
                    @foreach($featuredProducts as $product)
                    <div class="col-md-3">
                        <div class="cat-card">
                            <div class="product-image position-relative">
                                @if($product->image != "")
                                <a href="{{ route('products.show', $product->slug) }}" class="product-img">
                                    <img class="cat-image" src="{{ asset('storage/'.$product->image)}}" alt="">
                                </a>
                                @endif
                                <br>
                                </br>
                                <br>
                                </br>
                                <a class="whishlist" href="{{route('products.index')}}"><i class="far fa-heart"></i></a>

                                <div class="product-action">
                                <a href="javascript:void(0);" onclick="addToCart({{$product->id}});" class="btn btn-dark"><i class="fas fa-shopping-cart"></i> &nbsp;{{ __('messages.ADD TO CART') }}</a>
                                <a href="{{route('front.cart')}}"  class="btn btn-primary">{{ __('messages.Go To Cart') }}</a>
                                 </div>
                                 <br>
                                  <div href="{{route('front.home')}}" >
                                     <a href="javascript:void(0);" onclick="addToWishlist({{$product->id}});" class="btn btn-dark"><i class="fas fa-shopping-cart"></i> &nbsp;{{ __('messages.Wishlist') }}</a>
                                </div>
                            </div>
                            <div class="card-body text-center mt-3">
                                <a class="h6 link" href="{{ route('products.show', $product->slug) }}">{{ $product->translatedName }}</a>
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
                    @endif
                </div>
            </div>
        </section>
<!-- 
        <style>
        .cat-image {
            width: 100%;
            /* Ensures the image takes full width of its container */
            height: 200px;
            /* Sets a fixed height */
            object-fit: contain;
            /* Ensures the aspect ratio is maintained while filling the container */
            border-radius: 8px;
            /* Optional: Adds rounded corners */
        }

        .cat-card {
            overflow: hidden;
            /* Ensures the card doesn’t overflow */
            background: #f8f9fa;
            /* Optional: Adds a background color for the card */
            border: 1px solid #ddd;
            /* Optional: Adds a border to the card */
            border-radius: 8px;
            /* Optional: Makes the card corners rounded */
            padding: 10px;
            /* Optional: Adds padding inside the card */
            margin-bottom: 15px;
            /* Optional: Adds spacing between cards */
            text-align: center;
            /* Optional: Centers the text */
        }

        .product-action {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            width: 100%;
        }

        .product-action .btn {
            width: 80%;
        }

        .whishlist {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 18px;
            color: #e74c3c;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 5px;
            border-radius: 50%;
            transition: background-color 0.3s ease;
        }

        .whishlist:hover {
            background-color: #f39c12;
        }

        .card-body {
            padding: 15px;
        }

        .card-body .h6.link {
            font-size: 1rem;
            font-weight: bold;
            color: #333;
            text-decoration: none;
        }

        .card-body .price {
            margin-top: 10px;
        }

        .card-body .price .h5 {
            font-size: 1.25rem;
            color: #e74c3c;
        }

        .card-body .price .h6 {
            font-size: 1rem;
            color: #999;
            text-decoration: line-through;
        }

        @media (max-width: 768px) {
            .cat-card {
                margin-bottom: 20px;
            }
        }
        </style> -->

<section class="section-4 pt-5">
            <div class="container">
                <div class="section-title">
                    <h2>{{ __('messages.Leatest Products') }}</h2>
                </div>
                <div class="row pb-3">
                    @if($latestProducts->isNotEmpty())
                    @foreach($latestProducts as $product)
                    <div class="col-md-3">
                        <div class="cat-card">
                            <div class="product-image position-relative">
                                @if($product->image != "")
                                <a href="{{ route('products.show', $product->slug) }}" class="product-img">
                                    <img class="cat-image" src="{{ asset('storage/'.$product->image)}}" alt="">
                                </a>
                                @endif
                                <br>
                                </br>
                                <br>
                                </br>
                                <a class="whishlist" href="222"><i class="far fa-heart"></i></a>

                                <div class="product-action" href="{{route('front.cart')}}">
                                <a href="javascript:void(0);" onclick="addToCart({{$product->id}});" class="btn btn-dark"><i class="fas fa-shopping-cart"></i> &nbsp;{{ __('messages.ADD TO CART') }}</a>
    </div>
    <br>
    <div href="{{route('front.home')}}" >
                                     <a href="javascript:void(0);" onclick="addToWishlist({{$product->id}});" class="btn btn-dark"><i class="fas fa-shopping-cart"></i> &nbsp;{{ __('messages.Wishlist') }}</a>
                                </div>
                            </div>
                            <div class="card-body text-center mt-3">
                                <a class="h6 link" href="{{ route('products.show', $product->slug) }}">{{ $product->translatedName }}</a>
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
                    @endif
                </div>
            </div>
        </section>
        <section class="wishlist-section pt-5">
    <div class="container">
        <div class="section-title">
            <h2>{{ __('messages.Wishlist') }}</h2>
        </div>

        @if(auth()->check() && auth()->user()->wishlists->isNotEmpty())
    <div class="row">
        @foreach(auth()->user()->wishlists as $product)
            <div class="col-md-3">
                <div class="cat-card">
                    <div class="product-image position-relative">
                        @if($product->image)
                            <a href="{{ route('products.show', $product->slug) }}" class="product-img">
                                <img class="cat-image" src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->title }}">
                            </a>
                        @endif
                    </div>
                    <div class="card-body text-center mt-3">
                        <a class="h6 link" href="{{ route('products.show', $product->slug) }}">{{ $product->title }}</a>
                        <div class="price mt-2">
                            <span class="h5"><strong>${{ $product->price }}</strong></span>
                            @if($product->compare_price > 0)
                                <span class="h6 text-underline"><del>${{ $product->compare_price }}</del></span>
                            @endif
                        </div>
                        <form action="{{ route('wishlist.remove', $product->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm mt-2">Remove</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <p>{{ __('messages.Your wishlist is empty.') }}</p>
@endif

    </div>
</section>
       <!-- </main> -->
 @endsection
 @section('customJs')
<script type="text/javascript">
function addToCart(productId) {
    $.ajax({
        url: '{{ route("addToCart") }}',  // Replace with the actual route for adding to cart
        method: 'POST',
        data: {
            id: productId,
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.status) {
                alert(response.message); // Product added successfully
                // Update cart count if needed
                $('#cart-count').text(response.cartCount);
            } else {
                alert(response.message); // Product already in cart
            }
        },
        error: function(xhr, status, error) {
            alert("An error occurred");
        }
    });
}


</script>
<script type="text/javascript">
function addToWishlist(productId) {
    $.ajax({
        url: '/wishlist/add',
        method: 'POST',
        data: {
            id: productId,
            _token: '{{ csrf_token() }}' // Include CSRF token
        },
        success: function(response) {
            alert(response.message); // Display the success or failure message
        },
        error: function(xhr, status, error) {
            alert("An error occurred");
        }
    });
}
</script>
 @endsection