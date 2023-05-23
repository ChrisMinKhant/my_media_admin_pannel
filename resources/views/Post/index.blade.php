@extends('Layout.master')

@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <div class="row my-5">
                <span class="fs-1 fw-bold text-uppercase d-block text-center">Welcome Good Sir!</span>
            </div>
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show rounded-0 text-uppercase" role="alert">
                    <strong>Hello Good Sir,</strong> {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            {{-- Create Post Start --}}
            <div class="col-4">
                <div class="row sticky-top">
                    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data"
                        class="rounded-5 shadow-lg p-3 border border-dark border-2 my-5 text-center">
                        @csrf
                        {{-- Greeting Text Start --}}
                        <div class="my-5">
                            <span class="fs-6 fw-light text-uppercase d-block">You can create a post here.</span>
                        </div>
                        {{-- Greeting Text End --}}
                        {{-- Input And Button Start --}}
                        <div class="mb-3">
                            <label for="formFile" class="form-label float-start">Image</label>
                            <input class="form-control rounded-3 @error('image') is-invalid @enderror" type="file"
                                id="profile_image" name="image">
                            @error('image')
                                <small class="text-danger float-start">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <select
                                class="form-select @error('category_id')
                                is-invalid
                            @enderror"
                                id="floatingSelect" aria-label="Select Category" name="category_id">
                                <option selected value="">Select Category</option>
                                @foreach ($categoryData as $category)
                                    <option value={{ $category->id }}>{{ $category->title }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <small class="text-danger float-start">{{ $message }}</small>
                            @enderror
                            <label for="floatingSelect">Category Selection</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-3  @error('title') is-invalid @enderror"
                                id="floatingNameInput" placeholder="title" name="title">
                            @error('title')
                                <small class="text-danger float-start">{{ $message }}</small>
                            @enderror
                            <label for="floatinNamegInput" class="text-muted">Title</label>
                        </div>

                        <div class="form-floating mb-3">
                            <textarea
                                class="form-control @error('description')
                                is-invalid
                            @enderror"
                                placeholder="Description" id="description" style="height: 100px" name="description"></textarea>
                            @error('description')
                                <small class="text-danger float-start">{{ $message }}</small>
                            @enderror
                            <label for="description">Description</label>
                        </div>

                        <div class="row mt-5">
                            <div class="col-6 offset-3">
                                <button type="submit" class="btn btn-dark text-light w-100 rounded-5">Create</button>
                            </div>
                        </div>
                        {{-- Input And Button End --}}
                    </form>
                </div>
            </div>
            {{-- Create Post End --}}
            {{-- Post List Start --}}
            <div class="col-7 offset-1">
                <div class="row">
                    <div class="row my-5 rounded-5 shadow-lg p-3 border border-dark border-2">
                        <div class="row my-5 text-center">
                            <span class="fs-4 fw-light text-uppercase d-block">Here is post list.</span>
                        </div>
                        {{-- Admin List Start --}}
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Operation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($postData as $post)
                                    <tr class="align-middle">
                                        <td class="col-1">{{ $post->id }}</td>
                                        <td class="col-1"><img src="{{ asset('storage/' . $post->image) }}"
                                                style="max-width:100%;">
                                        </td>
                                        <td class="col-2">{{ Str::limit($post->category, 20, '...') }}</td>
                                        <td class="col-2">{{ Str::limit($post->title, 20, '...') }}</td>

                                        <td class="col-2">{{ Str::limit($post->description, 50, '...') }}</td>

                                        <td class="col-2">
                                            <a href="{{ route('post.show', $post->id) }}"><i class="fa-solid fa-eye me-3"
                                                    style="color: #000000;"></i></a>

                                            <a href="{{ route('post.edit', $post->id) }}"><i class="fa-solid fa-pen me-3"
                                                    style="color: #005eff;"></i></a>

                                            <form action="{{ route('post.destroy', $post->id) }}" method="post"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="d-inline"
                                                    style="border: none; background-color : inherit;"><i
                                                        class="fa-solid fa-trash" style="color: #ff0000;"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- Admin List End --}}
                        <div>
                            {{ $postData->links() }}
                        </div>
                    </div>
                </div>
            </div>
            {{-- Post List End --}}
        </div>
    </div>
@endsection
