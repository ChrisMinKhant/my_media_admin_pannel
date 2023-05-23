@extends('Layout.master')

@section('main-content')
    <div class="container-fluid">
        <div class="row text-center">
            <div class="rounded-5 shadow-lg p-3 border border-dark border-2 col-6 offset-3 my-5 ">
                <div class="my-3">
                    <span class="fs-5 fw-bold text-uppercase d-block">Welcome Good Sir!</span>
                    <span class="fs-6 fw-light text-uppercase d-block">here is your profile.</span>
                </div>
                {{-- Profile Start --}}
                <div class="fw-bold my-5">
                    <img src="{{ asset('storage/' . $adminData->profile_photo_path) }}" class="mb-4" style="width:25%;">

                    <div class="row mt-4">
                        <div class="col-5">Name</div>
                        <div class="col-2"> : </div>
                        <div class="col-5">{{ $adminData->name }}</div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-5">Email</div>
                        <div class="col-2"> : </div>
                        <div class="col-5">{{ $adminData->email }}</div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-5">Phone</div>
                        <div class="col-2"> : </div>
                        <div class="col-5">{{ $adminData->phone }}</div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-5">Address</div>
                        <div class="col-2"> : </div>
                        <div class="col-5">{{ $adminData->address }}</div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-5">Joined At</div>
                        <div class="col-2"> : </div>
                        <div class="col-5">{{ $adminData->created_at->format('Y-M-d') }}</div>
                    </div>
                </div>
                {{-- Profile End --}}

                <div class="row">
                    <div class="col-6">
                        <button type="button" class="btn btn-dark text-light w-100 rounded-5" onclick="history.back()"><i
                                class="fa-solid fa-arrow-left me-2" style="color: #ffffff;"></i>Back</button>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.edit', $adminData->id) }}" class="btn btn-dark rounded-5 w-100"><i
                                class="fa-solid fa-pen me-2" style="color: #ffffff;"></i>Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
