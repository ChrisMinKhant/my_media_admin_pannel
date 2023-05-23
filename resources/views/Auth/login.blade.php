@extends('Auth.master')

@section('title')
    My Media Admin Panel - Login Page
@endsection

@section('style')
    style="height:100vh";
@endsection

@section('main_form')
    <form action="{{ route('login') }}" method="post" class="rounded-5 shadow-lg p-3 border border-dark border-2"
        style="background: rgba(255,255,255,0.8);">
        @csrf
        {{-- Greeting Text Start --}}
        <div class="my-5">
            <span class="fs-5 fw-bold text-uppercase d-block">Hello Again!</span>
            <span class="fs-6 fw-light text-uppercase d-block">Welcome Back, You've been missed!</span>
        </div>
        {{-- Greeting Text End --}}
        {{-- Input And Button Start --}}
        <div class="form-floating mb-3">
            <input type="email"
                class="form-control rounded-3 @error('email')
                is-invalid
            @enderror"
                id="floatingInput" placeholder="name@example.com" name="email">
            @error('email')
                <small class="text-danger float-start">{{ $message }}</small>
            @enderror
            <label for="floatingInput" class="text-muted">Email address</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password"
                class="form-control rounded-3 @error('password')
                is-invalid
            @enderror"
                id="floatingPassword" placeholder="Password" name="password">
            @error('password')
                <small class="text-danger float-start">{{ $message }}</small>
            @enderror
            <label for="floatingPassword" class="text-muted">Password</label>
        </div>

        <div class="row mt-5">
            <div class="col-6 offset-3">
                <button type="submit" class="btn btn-dark text-light w-100 rounded-5">Login</button>
            </div>
        </div>
        {{-- Input And Button End --}}
        {{-- Register Address Start --}}
        <div class="mt-3 mb-3">
            <a href="{{ route('register') }}" class="text-decoration-none text-primary">Do not have an account?</a>
        </div>
        {{-- Register Address End --}}
    </form>
@endsection
