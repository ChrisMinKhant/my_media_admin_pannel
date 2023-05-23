@extends('Layout.master')

@section('main-content')
    <div class="container-fluid">
        <div class="row mt-5 text-center">
            <span class="fs-3 fw-bold text-uppercase d-block">Welcome Good Sir!</span>
            <span class="fs-4 fw-light text-uppercase d-block">Here is Action Logs.</span>
        </div>

        @if (session('status'))
            <div class="alert alert-warning alert-dismissible fade show rounded-0 text-uppercase" role="alert">
                <strong>Hello Good Sir,</strong> {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row m-3 rounded-5 shadow-lg p-3 border border-dark border-2">
            {{-- Admin List Start --}}
            <table class="table text-center">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Post</th>
                        <th scope="col">User</th>
                        <th scope="col">Like</th>
                        <th scope="col">Comment</th>
                        <th scope="col">Created At</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($actionLogData as $actionLog)
                        <tr class="align-middle">
                            <td class="col-2">{{ $actionLog->id }}</td>
                            <td class="col-2">{{ $actionLog->post_title }}</td>
                            <td class="col-2">{{ $actionLog->user_name }}</td>
                            <td class="col-1">
                                @if ($actionLog->like == 0)
                                    <i class="fa-sharp fa-solid fa-circle-dot" style="color: #ff0000;"></i>
                                @else
                                    <i class="fa-sharp fa-solid fa-circle-dot" style="color: #00ff2a;"></i>
                                @endif
                            </td>
                            <td class="col-2">{{ Str::limit($actionLog->comment, 50, '...') }}</td>
                            <td class="col-2">{{ $actionLog->created_at->format('M-d-Y') }}</td>
                            <td class="col-1">
                                <a href="{{ route('actionlog.show', $actionLog->id) }}"><i class="fa-solid fa-eye me-3"
                                        style="color: #000000;"></i></a>
                                <form action="{{ route('actionlog.destroy', $actionLog->id) }}" method="post"
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
                {{ $actionLogData->links() }}
            </div>
        </div>
    </div>
@endsection
