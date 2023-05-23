@extends('Layout.master')

@section('main-content')
    <div class="container-fluid">
        <div class="row mt-5 text-center">
            <span class="fs-3 fw-bold text-uppercase d-block">Welcome Good Sir!</span>
            <span class="fs-4 fw-light text-uppercase d-block">Here is admin list.</span>
        </div>
        <div class="row mx-3 my-4">
            <a href="{{ route('admin.create') }}"
                class="btn btn-light rounded-5 shadow-lg col-2 offset-10 border border-dark border-2 fw-bold"><i
                    class="fa-solid fa-plus me-2" style="color: #000000;"></i>Create</a>
        </div>
        <div class="row m-3 rounded-5 shadow-lg p-3 border border-dark border-2">
            {{-- Admin List Start --}}
            <table class="table text-center">
                <thead>
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Address</th>
                        <th scope="col">Operation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($adminListData as $admin)
                        <tr class="align-middle">
                            <td class="col-1"><img src="{{ asset('storage/' . $admin->profile_photo_path) }}"
                                    style="max-width:50%;"></td>
                            <td class="col-2">{{ $admin->name }}</td>
                            <td class="col-2">{{ $admin->email }}</td>
                            <td class="col-2">{{ $admin->phone }}</td>
                            <td class="col-3">{{ $admin->address }}</td>
                            <td class="col-2"><a href="{{ route('admin.show', $admin->id) }}"><i
                                        class="fa-solid fa-eye me-3" style="color: #000000;"></i></a>
                                <a href="{{ route('admin.edit', $admin->id) }}"><i class="fa-solid fa-pen me-3"
                                        style="color: #005eff;"></i></a>
                                <form action="{{ route('admin.destroy', $admin->id) }}" method="post" class="d-inline">
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
                {{ $adminListData->links() }}
            </div>
        </div>
    </div>
@endsection
