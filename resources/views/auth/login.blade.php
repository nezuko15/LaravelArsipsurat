@extends('layouts.app')

{{-- @section('content')    
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100 d-flex align-items-center bg-primary">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-4 col-lg-5 col-md-7">
                            <div class="card card-plain bg-white">
                                <div class="card-header pb-0 text-center">
                                    <h4 class="font-weight-bolder">Sign In</h4>
                                    <p class="mb-0">Enter your email and password to sign in</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="POST" action="{{ route('login.perform') }}">
@csrf
@method('post')
<div class="mb-3">
    <input type="email" name="email" class="form-control form-control-lg" value="{{ old('email') ?? 'admin@argon.com' }}" aria-label="Email">
    @error('email') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
</div>
<div class="mb-3">
    <input type="password" name="password" class="form-control form-control-lg" aria-label="Password" value="secret">
    @error('password') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
</div>
<div class="form-check form-switch mb-3">
    <input class="form-check-input" name="remember" type="checkbox" id="rememberMe">
    <label class="form-check-label" for="rememberMe">Remember me</label>
</div>
<div class="text-center">
    <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Sign in</button>
</div>
</form>
</div>
<div class="card-footer text-center pt-0 px-lg-2 px-1">
    <p class="mb-1 text-sm mx-auto">
        Forgot your password? Reset your password
        <a href="{{ route('reset-password') }}" class="text-primary text-gradient font-weight-bold">here</a>
    </p>
</div>
<div class="card-footer text-center pt-0 px-lg-2 px-1">
    <p class="mb-4 text-sm mx-auto">
        Don't have an account?
        <a href="{{ route('register') }}" class="text-primary text-gradient font-weight-bold">Sign up</a>
    </p>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
</main>
@endsection --}}

@section('content')
<main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 text-center mx-auto">
                    <h1 class="text-white mb-2 mt-5">Selamat Datang!</h1>
                    <p class="text-lead text-white">Aplikasi Pengarsipan Surat Resmi Desa Ngringin</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
            <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                <div class="card z-index-0">
                    <div class="card-header text-center pt-4">
                        <h5>Sign In</h5>
                    </div>
                    <div class="card-body">
                        <form role="form" method="POST" action="{{ route('login.perform') }}">
                            @csrf
                            @method('post')
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control form-control-lg" value="" aria-label="Email" placeholder="Email">
                                @error('email') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                            </div>
                            <div class="mb-3">
                                <input type="password" name="password" class="form-control form-control-lg" aria-label="Password" value="" placeholder="Password">
                                @error('password') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                            </div>
                            {{-- <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" name="remember" type="checkbox" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">Remember me</label>
                                </div> --}}
                            <div class="text-center">
                                <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Sign in</button>
                            </div>
                        </form>
                    </div>
                    {{-- <div class="card-footer text-center pt-0 px-lg-2 px-1">
                            <p class="mb-1 text-sm mx-auto">
                                Forgot your password? Reset your password
                                <a href="{{ route('reset-password') }}" class="text-primary text-gradient font-weight-bold">here</a>
                    </p>
                </div> --}}
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                    <p class="mb-4 text-sm mx-auto">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="text-primary text-gradient font-weight-bold">Sign up</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>
@endsection