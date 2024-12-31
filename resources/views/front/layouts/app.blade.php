<!DOCTYPE html>
<html class="no-js" lang="en_AU" />

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Laravel Online Shop</title>
    <meta name="description" content="" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />

    <meta name="HandheldFriendly" content="True" />
    <meta name="pinterest" content="nopin" />

    <meta property="og:locale" content="en_AU" />
    <meta property="og:type" content="website" />
    <meta property="fb:admins" content="" />
    <meta property="fb:app_id" content="" />
    <meta property="og:site_name" content="" />
    <meta property="og:title" content="" />
    <meta property="og:description" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width" content="" />
    <meta property="og:image:height" content="" />
    <meta property="og:image:alt" content="" />

    <meta name="twitter:title" content="" />
    <meta name="twitter:site" content="" />
    <meta name="twitter:description" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:image:alt" content="" />
    <meta name="twitter:card" content="summary_large_image" />

    <!-- Single version of Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="css/style.css?v=<?php echo rand(111,999); ?>" />
    <link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/slick.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/slick-theme.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/ion.rangeSlider.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/css/style.css')}}" />

    <link rel="stylesheet" href="http://localhost/laravel/laravel_online_shop/public/css/style.css">
    <link rel="stylesheet" href="http://localhost/laravel/laravel_online_shop/public/css/style.css">

    <!-- Bootstrap JS with Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="http://localhost/laravel/laravel_online_shop/public/js/script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

    <!-- Fav Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="#" />
</head>
<style>
/* Subcategory links (dropdown items) color to white */
.nav-item .dropdown-menu .dropdown-item {
    color: white; /* Set the text color to white */
}

.nav-item .dropdown-menu .dropdown-item:hover {
    background-color: #007bff; /* Optional: Add a hover effect (e.g., blue background) */
    color: white; /* Ensure the text stays white on hover */
}
</style>

<body data-instant-intensity="mousedown">

    <div class="bg-light top-header">
        <div class="container">
            <div class="row align-items-center py-3 d-none d-lg-flex justify-content-between">
                <div class="col-lg-4 logo">
                    <a href="{{route('front.shop')}}" class="text-decoration-none">
                        <span class="h1 text-uppercase text-primary bg-dark px-2">Online</span>
                        <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">SHOP</span>
                    </a>
                </div>
                <div class="col-lg-6 col-6 text-left  d-flex justify-content-end align-items-center">
                    <a href="account.php" class="nav-link text-dark">My Account</a>
                    <form action="">
                        <div class="input-group">
                            <input type="text" placeholder="Search For Products" class="form-control"
                                aria-label="Amount (to the nearest dollar)">
                            <span class="input-group-text">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <header class="bg-dark">
        <div class="container">
            <nav class="navbar navbar-expand-xl" id="navbar">

                <button class="navbar-toggler menu-btn" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <i class="navbar-toggler-icon fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @if(getCategories()->isNotEmpty())
                        @foreach(getCategories() as $category)
                        <li class="nav-item dropdown">
                            <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                {{ $category->name}}
                            </button>
                            @if($category->subcategories->isNotEmpty())
                            <ul class="dropdown-menu dropdown-menu-dark">
                                @foreach($category->subcategories as $subCategory)
                                <li><a class="dropdown-item nav-link" href="#">{{ $subCategory->name}}</a></li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        @endforeach
                        @endif
                    </ul>
                </div>
                <div class="right-nav py-0">
                    <a href="cart.php" class="ml-3 d-flex pt-2">
                        <i class="fas fa-shopping-cart text-primary"></i>
                    </a>
                </div>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="bg-dark mt-5">
        <div class="container pb-5 pt-3">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-card">
                        <h3>Get In Touch</h3>
                        <p>No dolore ipsum accusam no lorem. <br>
                            123 Street, New York, USA <br>
                            exampl@example.com <br>
                            000 000 0000</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="footer-card">
                        <h3>Important Links</h3>
                        <ul>
                            <li><a href="about-us.php" title="About">About</a></li>
                            <li><a href="contact-us.php" title="Contact Us">Contact Us</a></li>
                            <li><a href="#" title="Privacy">Privacy</a></li>
                            <li><a href="#" title="Privacy">Terms & Conditions</a></li>
                            <li><a href="#" title="Privacy">Refund Policy</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="footer-card">
                        <h3>My Account</h3>
                        <ul>
                            <li><a href="#" title="Sell">Login</a></li>
                            <li><a href="#" title="Advertise">Register</a></li>
                            <li><a href="#" title="Contact Us">My Orders</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-area">
            <div class="container">
                <div class="row">
                    <div class="col-12 mt-3">
                        <div class="copy-right text-center">
                            <p>© Copyright 2022 Amazing Shop. All Rights Reserved</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('front-assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/instantpages.5.1.0.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/lazyload.17.6.0.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/custom.js') }}"></script>
    @yield('customJs')

    <script>
        window.onscroll = function() {
            myFunction()
        };

        var navbar = document.getElementById("navbar");
        var sticky = navbar.offsetTop;

        function myFunction() {
            if (window.pageYOffset >= sticky) {
                navbar.classList.add("sticky")
            } else {
                navbar.classList.remove("sticky");
            }
        }
    </script>
</body>

