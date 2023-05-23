@extends('Layout.master')

@section('main-content')
    <div class="container-fluid">
        <div class="row text-center">
            <div class="rounded-5 shadow-lg p-3 border border-dark border-2 col-6 offset-3 my-5 ">
                <div class="my-3">
                    <span class="fs-5 fw-bold text-uppercase d-block">Welcome Good Sir!</span>
                    <span class="fs-6 fw-light text-uppercase d-block">here is category details.</span>
                </div>
                {{-- Profile Start --}}
                <div class="my-5 mx-3">
                    <img src="{{ asset('storage/' . $categoryData->image) }}" class="mb-4" style="width:25%;">

                    <div class="d-flex mt-4">
                        <div class="btn btn-sm btn-dark shadow-sm rounded-5 fw-bold">Title :
                            {{ $categoryData->title }}
                        </div>
                        <div class="btn btn-sm btn-dark shadow-sm rounded-5 fw-bold ms-2">Created At :
                            {{ $categoryData->created_at->format('Y-M-d') }}
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="text-muted fs-5 text-start fw-bold">Description</div>
                        <div class="fs-6 text-start mt-3">
                            {{ $categoryData->description }}
                        </div>
                    </div>
                </div>
                {{-- Profile End --}}

                <div class="row">
                    <div class="col-6">
                        <button type="button" class="btn btn-dark text-light w-100 rounded-5" onclick="history.back()"><i
                                class="fa-solid fa-arrow-left me-2" style="color: #ffffff;"></i>Back</button>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('category.edit', $categoryData->id) }}" class="btn btn-dark rounded-5 w-100"><i
                                class="fa-solid fa-pen me-2" style="color: #ffffff;"></i>Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
