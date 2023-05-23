@extends('layout.master')

@section('main-content')
    <div class="row">
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show rounded-0 text-uppercase" role="alert">
                <strong>Hello Good Sir,</strong> {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form action="{{ route('post.update', $postData->id) }}" method="post" enctype="multipart/form-data"
            class="rounded-5 shadow-lg p-3 border border-dark border-2 col-6 offset-3 my-5 text-center">
            @csrf
            @method('PUT')
            {{-- Greeting Text Start --}}
            <div class="my-5">
                <span class="fs-5 fw-bold text-uppercase d-block">Welcome Good Sir!</span>
                <span class="fs-6 fw-light text-uppercase d-block">You can edit a category here.</span>
            </div>
            {{-- Greeting Text End --}}
            {{-- Input And Button Start --}}
            <div class="mb-3">
                <label for="formFile" class="form-label float-start">Image</label>
                <input
                    class="form-control rounded-3 @error('image')
                    is-invalid
                @enderror"
                    type="file" id="forFile" name="image">
                @error('image')
                    <small class="text-danger float-start">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input type="text"
                    class="form-control rounded-3  @error('title')
            is-invalid
            @enderror"
                    id="floatingNameInput" placeholder="title" name="title" value="{{ $postData->title }}">
                @error('title')
                    <small class="text-danger float-start">{{ $message }}</small>
                @enderror
                <label for="floatinNamegInput" class="text-muted">title</label>
            </div>

            <div class="form-floating mb-3">
                <select class="form-select @error('category_id')
                    is-invalid
                @enderror"
                    id="floatingSelect" aria-label="Select Category" name="category_id">
                    <option selected value="">Select Category</option>
                    @foreach ($categoryData as $category)
                        <option value={{ $category->id }} @selected($category->id == $postData->category_id)>{{ $category->title }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <small class="text-danger float-start">{{ $message }}</small>
                @enderror
                <label for="floatingSelect">Category Selection</label>
            </div>

            <div class="form-floating">
                <textarea class="form-control @error('description')
                is-invalid
                @enderror"
                    placeholder="Description" id="floatingTextarea2" style="height: 100px" name="description">{{ $postData->description }}</textarea>
                @error('description')
                    <small class="text-danger float-start">{{ $message }}</small>
                @enderror
                <label for="floatingTextarea2">Description</label>
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
