@extends('Auth.master')

@section('title')
    My Media Admin Panel - Register Page
@endsection

@section('style')
    style="height:100%";
@endsection

@section('main_form')
    <form action="{{ route('register') }}" method="post" class="rounded-5 shadow-lg p-3 border border-dark border-2"
        style="background: rgba(255,255,255,0.8);">
        @csrf
        {{-- Greeting Text Start --}}
        <div class="my-5">
            <span class="fs-5 fw-bold text-uppercase d-block">Good Whatever!</span>
            <span class="fs-6 fw-light text-uppercase d-block">Welcome To My Media App Admin Panel!</span>
        </div>
        {{-- Greeting Text End --}}
        {{-- Input And Button Start --}}
        <div class="form-floating mb-3">
            <input type="text" class="form-control rounded-3  @error('name')
            is-invalid
            @enderror"
                id="floatingNameInput" placeholder="name" name="name">
            @error('name')
                <small class="text-danger float-start">{{ $message }}</small>
            @enderror
            <label for="floatinNamegInput" class="text-muted">Name</label>
        </div>

        <div class="form-floating mb-3">
            <input type="email"
                class="form-control rounded-3 @error('email')
            is-invalid
            @enderror"
                id="floatingEmailInput" placeholder="name@example.com" name="email">
            @error('email')
                <small class="text-danger float-start">{{ $message }}</small>
            @enderror
            <label for="floatingEmailInput" class="text-muted">Email address</label>
        </div>

        <div class="form-floating mb-3">
            <input type="number"
                class="form-control rounded-3 @error('phone')
            is-invalid
            @enderror"
                id="floatingPhoneInput" placeholder="phone" name="phone">
            @error('phone')
                <small class="text-danger float-start">{{ $message }}</small>
            @enderror
            <label for="floatingPhoneInput" class="text-muted">Phone</label>
        </div>

        <div class="form-floating mb-3">
            <input type="text"
                class="form-control rounded-3 @error('address')
            is-invalid
            @enderror"
                id="floatingAddressInput" placeholder="address" name="address">
            @error('address')
                <small class="text-danger float-start">{{ $message }}</small>
            @enderror
            <label for="floatingAddressInput" class="text-muted">Address</label>
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

        <div class="form-floating mb-3">
            <input type="password"
                class="form-control rounded-3 @error('password_confirmation')
            is-invalid
            @enderror"
                id="floatingPassword" placeholder="PasswordConfirmation" name="password_confirmation">
            @error('password_confirmation')
                <small class="text-danger float-start">{{ $message }}</small>
            @enderror
            <label for="floatingPassword" class="text-muted">Confirm Password</label>
        </div>

        <div class="row mt-5">
            <div class="col-6 offset-3">
                <button type="submit" class="btn btn-dark text-light w-100 rounded-5">Register</button>
            </div>
        </div>
        {{-- Input And Button End --}}
        {{-- Register Address Start --}}
        <div class="mt-3 mb-3">
            <a href="{{ route('login') }}" class="text-decoration-none text-primary">Already have an account?</a>
        </div>
        {{-- Register Address End --}}
    </form>
@endsection
