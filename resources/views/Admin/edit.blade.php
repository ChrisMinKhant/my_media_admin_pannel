@extends('Layout.master')

@section('main-content')
    <div class="row">
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show rounded-0 text-uppercase" role="alert">
                <strong>Hello Good Sir,</strong> {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form action="{{ route('admin.update', $adminData->id) }}" method="post" enctype="multipart/form-data"
            class="rounded-5 shadow-lg p-3 border border-dark border-2 col-6 offset-3 my-5 text-center">
            @method('PUT')
            @csrf
            {{-- Greeting Text Start --}}
            <div class="my-5">
                <span class="fs-5 fw-bold text-uppercase d-block">Welcome Good Sir!</span>
                <span class="fs-6 fw-light text-uppercase d-block">You can create an admin profile here.</span>
            </div>
            {{-- Greeting Text End --}}
            {{-- Input And Button Start --}}
            <div class="mb-3">
                <label for="formFile" class="form-label float-start">Profile Image</label>
                <input
                    class="form-control rounded-3 @error('profile_photo_path')
                is-invalid
            @enderror"
                    type="file" id="profile_image" name="profile_photo_path">
                @error('profile_photo_path')
                    <small class="text-danger float-start">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control rounded-3  @error('name')
        is-invalid
        @enderror"
                    id="floatingNameInput" placeholder="name" name="name" value="{{ $adminData->name }}">
                @error('name')
                    <small class="text-danger float-start">{{ $message }}</small>
                @enderror
                <label for="floatinNamegInput" class="text-muted">Name</label>
            </div>

            <div class="form-floating mb-3">
                <input type="email" class="form-control rounded-3 @error('email')
        is-invalid
        @enderror"
                    id="floatingEmailInput" placeholder="name@example.com" name="email" value="{{ $adminData->email }}">
                @error('email')
                    <small class="text-danger float-start">{{ $message }}</small>
                @enderror
                <label for="floatingEmailInput" class="text-muted">Email address</label>
            </div>

            <div class="form-floating mb-3">
                <input type="number" class="form-control rounded-3 @error('phone')
        is-invalid
        @enderror"
                    id="floatingPhoneInput" placeholder="phone" name="phone" value="{{ $adminData->phone }}">
                @error('phone')
                    <small class="text-danger float-start">{{ $message }}</small>
                @enderror
                <label for="floatingPhoneInput" class="text-muted">Phone</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control rounded-3 @error('address')
        is-invalid
        @enderror"
                    id="floatingAddressInput" placeholder="address" name="address" value="{{ $adminData->address }}">
                @error('address')
                    <small class="text-danger float-start">{{ $message }}</small>
                @enderror
                <label for="floatingAddressInput" class="text-muted">Address</label>
            </div>

            <div class="row mt-5">
                <div class="col-6 offset-3">
                    <button type="submit" class="btn btn-dark text-light w-100 rounded-5">Update</button>
                </div>
            </div>
            {{-- Input And Button End --}}
        </form>
    </div>
@endsection
