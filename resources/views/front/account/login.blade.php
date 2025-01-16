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

       
<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                    <li class="breadcrumb-item">Login</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-10">
        <div class="container">
            <div class="login-form">    
                <form action="{{ route('login.submit') }}" method="POST">
                    @csrf
                    <h4 class="modal-title">Login to Your Account</h4>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Email" value="{{ old('email') }}" id="email" name="email" required="required" >
                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" value="{{ old('password') }}" id="password" name="password" required="required" >
                        @error('password')
                        <small class="text-danger">{{ $message }}</small>
                         @enderror
                    </div>
                    <div class="form-group small">
                        <a href="#" class="forgot-link">Forgot Password?</a>
                    </div> 
                    <input type="submit" class="btn btn-dark btn-block btn-lg" value="Login">              
                 </form>			
                <div class="text-center small">Don't have an account? <a href="{{route('account.register')}}">Sign up</a></div>
            </div>
        </div>
    </section>
</main>
@endsection