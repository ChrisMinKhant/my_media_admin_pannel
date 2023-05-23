@extends('Layout.master')

@section('main-content')
    <div class="container-fluid">
        <div class="row text-center">
            <div class="rounded-5 shadow-lg p-3 border border-dark border-2 col-6 offset-3 my-5 ">
                <div class="my-3">
                    <span class="fs-5 fw-bold text-uppercase d-block">Welcome Good Sir!</span>
                    <span class="fs-6 fw-light text-uppercase d-block">here is action log details.</span>
                </div>
                {{-- Profile Start --}}
                <div class="my-5 mx-3">

                    <div class="d-flex mt-4">
                        <div class="btn btn-sm btn-dark shadow-sm rounded-5 fw-bold">Post Title :
                            {{ $actionLogData->post_title }}
                        </div>
                        <div class="btn btn-sm btn-dark shadow-sm rounded-5 fw-bold ms-2">User Name :
                            {{ $actionLogData->user_name }}
                        </div>
                    </div>

                    <div class="d-flex mt-4">
                        <div class="btn btn-sm btn-dark shadow-sm rounded-5 fw-bold">Like :
                            @if ($actionLogData->like == 0)
                                <i class="fa-sharp fa-solid fa-circle-dot ms-2" style="color: #ff0000;"></i>
                            @else
                                <i class="fa-sharp fa-solid fa-circle-dot ms-2" style="color: #00ff2a;"></i>
                            @endif
                        </div>
                        <div class="btn btn-sm btn-dark shadow-sm rounded-5 fw-bold ms-2">Created At :
                            {{ $actionLogData->created_at->format('M-d-Y') }}
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="text-muted fs-5 text-start fw-bold">Comment</div>
                        <div class="fs-6 text-start mt-3">
                            {{ $actionLogData->comment }}
                        </div>
                    </div>
                </div>
                {{-- Profile End --}}

                <div class="row">
                    <div class="col-6 offset-3">
                        <button type="button" class="btn btn-dark text-light w-100 rounded-5" onclick="history.back()"><i
                                class="fa-solid fa-arrow-left me-2" style="color: #ffffff;"></i>Back</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
