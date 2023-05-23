@extends('Layout.master')

@section('main-content')
    <div class="container-fluid">
        <div class="row mt-5 text-center">
            <span class="fs-3 fw-bold text-uppercase d-block">Welcome Good Sir!</span>
            <span class="fs-4 fw-light text-uppercase d-block">Here is category list.</span>
        </div>
        <div class="row mx-3 my-4">
            <a href="{{ route('category.create') }}"
                class="btn btn-light rounded-5 shadow-lg col-2 offset-10 border border-dark border-2 fw-bold"><i
                    class="fa-solid fa-plus me-2" style="color: #000000;"></i>Create</a>
        </div>
        <div class="row m-3 rounded-5 shadow-lg p-3 border border-dark border-2">
            {{-- Admin List Start --}}
            <table class="table text-center">
                <thead>
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Operation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categoryData as $category)
                        <tr class="align-middle">
                            <td class="col-1"><img src="{{ asset('storage/' . $category->image) }}" style="max-width:50%;">
                            </td>
                            <td class="col-2">{{ $category->title }}</td>

                            <td class="col-2">{{ Str::limit($category->description, 50, '...') }}</td>

                            <td class="col-2">{{ $category->created_at->format('Y-M-d') }}</td>

                            <td class="col-2">
                                <a href="{{ route('category.show', $category->id) }}"><i class="fa-solid fa-eye me-3"
                                        style="color: #000000;"></i></a>

                                <a href="{{ route('category.edit', $category->id) }}"><i class="fa-solid fa-pen me-3"
                                        style="color: #005eff;"></i></a>

                                <form action="{{ route('category.destroy', $category->id) }}" method="post"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="d-inline"
                                        style="border: none; background-color : inherit;"><i class="fa-solid fa-trash"
                                            style="color: #ff0000;"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- Admin List End --}}
            <div>
                {{ $categoryData->links() }}
            </div>
        </div>
    </div>
@endsection
