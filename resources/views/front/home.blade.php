@extends('front.layouts.app')
@section('content')
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
                                <h1 class="display-4 text-white mb-3">Kids Fashion</h1>
                                <p class="mx-md-5 px-5">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo
                                    stet amet amet ndiam elitr ipsum diam</p>
                                <a class="btn btn-outline-light py-2 px-4 mt-3" href="#">Shop Now</a>
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
                                <h1 class="display-4 text-white mb-3">Womens Fashion</h1>
                                <p class="mx-md-5 px-5">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo
                                    stet amet amet ndiam elitr ipsum diam</p>
                                <a class="btn btn-outline-light py-2 px-4 mt-3" href="#">Shop Now</a>
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
                                <h1 class="display-4 text-white mb-3">Shop Online at Flat 70% off on Branded Clothes
                                </h1>
                                <p class="mx-md-5 px-5">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo
                                    stet amet amet ndiam elitr ipsum diam</p>
                                <a class="btn btn-outline-light py-2 px-4 mt-3" href="#">Shop Now</a>
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
                            <h2 class="font-weight-semi-bold m-0">Quality Product</h5>
                        </div>
                    </div>
                    <div class="col-lg-3 ">
                        <div class="box shadow-lg">
                            <div class="fa icon fa-shipping-fast text-primary m-0 mr-3"></div>
                            <h2 class="font-weight-semi-bold m-0">Free Shipping</h2>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="box shadow-lg">
                            <div class="fa icon fa-exchange-alt text-primary m-0 mr-3"></div>
                            <h2 class="font-weight-semi-bold m-0">14-Day Return</h2>
                        </div>
                    </div>
                    <div class="col-lg-3 ">
                        <div class="box shadow-lg">
                            <div class="fa icon fa-phone-volume text-primary m-0 mr-3"></div>
                            <h2 class="font-weight-semi-bold m-0">24/7 Support</h5>
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
                    <h2>Categories</h2>
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
                                    <h2>{{ $category->name }}</h2>
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
                    <h2>Featured Products</h2>
                </div>
                <div class="row pb-3">
                    @if($featuredProducts->isNotEmpty())
                    @foreach($featuredProducts as $product)
                    <div class="col-md-3">
                        <div class="cat-card">
                            <div class="product-image position-relative">
                                @if($product->image != "")
                                <a href="" class="product-img">
                                    <img class="cat-image" src="{{ asset('storage/'.$product->image)}}" alt="">
                                </a>
                                @endif
                                <br>
                                </br>
                                <br>
                                </br>
                                <a class="whishlist" href="{{route('products.index')}}"><i class="far fa-heart"></i></a>

                                <div class="product-action">
                                    <a class="btn btn-dark" href="#">
                                        <i class="fa fa-shopping-cart"></i> Add To Cart
                                    </a>

                                </div>
                            </div>
                            <div class="card-body text-center mt-3">
                                <a class="h6 link" href="{{ route('products.show', $product->id) }}">{{$product->title}}</a>
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
        </style>



<section class="section-4 pt-5">
            <div class="container">
                <div class="section-title">
                    <h2>Leatest Products</h2>
                </div>
                <div class="row pb-3">
                    @if($latestProducts->isNotEmpty())
                    @foreach($latestProducts as $product)
                    <div class="col-md-3">
                        <div class="cat-card">
                            <div class="product-image position-relative">
                                @if($product->image != "")
                                <a href="" class="product-img">
                                    <img class="cat-image" src="{{ asset('storage/'.$product->image)}}" alt="">
                                </a>
                                @endif
                                <br>
                                </br>
                                <br>
                                </br>
                                <a class="whishlist" href="222"><i class="far fa-heart"></i></a>

                                <div class="product-action">
                                    <a class="btn btn-dark" href="#">
                                        <i class="fa fa-shopping-cart"></i> Add To Cart
                                    </a>

                                </div>
                            </div>
                            <div class="card-body text-center mt-3">
                                <a class="h6 link" href="product.php">{{$product->title}}</a>
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
        <!-- </main> -->
 @endsection