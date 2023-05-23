<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Media App - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container-fluid">
        {{-- Nav Bar Start --}}
        <div class="row bg-primary text-light p-2 align-items-center">
            {{-- Nav Bar Title Start --}}
            <div class="col-6 fs-3 fw-bold">
                <span>Media App Admin Dashboard</span><i class="fa-solid fa-photo-film ms-3"
                    style="color: #ffffff;"></i>
            </div>
            {{-- Nav Bar Title End --}}
            {{-- Profile Image and Button Start --}}
            <div class="col-6 text-end">
                <a href="#" class="btn"><img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}"
                        class="rounded-circle" style="width:  50px;">
                    <span class="text-uppercase fs-6 fw-bold ms-2">{{ Auth::user()->name }}</span></a>
            </div>
            {{-- Profile Image and Button End --}}
        </div>
        {{-- Nav Bar End --}}
        {{-- Main Dashboard Start --}}
        <div class="row" style="height:100vh;">
            {{-- Side Nav Bar Start --}}
            <div class="col-2 shadow-sm" style="background-color: #dfe1e5;">
                <ul class="nav-bar list-unstyled mt-3 text-uppercase">
                    <li class="nav-item m-4"><a href="{{ route('admin.show', Auth::user()->id) }}"
                            class="btn btn-light rounded-5 nav-link p-1 shadow-sm fs-6 fw-bold"><i
                                class="fa-solid fa-user me-3" style="color: #000000;"></i>Profile</a>
                    </li>
                    <li class="nav-item m-4"><a href="{{ route('admin.index') }}"
                            class="btn btn-light rounded-5 nav-link p-1 shadow-sm fs-6 fw-bold"><i
                                class="fa-solid fa-list-ul me-3" style="color: #000000;"></i>Admin
                            List</a>
                    </li>
                    <li class="nav-item m-4"><a href="{{ route('post.index') }}"
                            class="btn btn-light rounded-5 nav-link p-1 shadow-sm fs-6 fw-bold"><i
                                class="fa-solid fa-signs-post me-3" style="color: #000000;"></i>Post List</a>
                    </li>
                    <li class="nav-item m-4"><a href="{{ route('category.index') }}"
                            class="btn btn-light rounded-5 nav-link p-1 shadow-sm fs-6 fw-bold"><i
                                class="fa-regular fa-folder-open me-3" style="color: #000000;"></i>Category</a>
                    </li>
                    <li class="nav-item m-4"><a href="{{ route('actionlog.index') }}"
                            class="btn btn-light rounded-5 nav-link p-1 shadow-sm fs-6 fw-bold"><i
                                class="fa-solid fa-chart-simple me-2" style="color: #000000;"></i>Action Logs</a>
                    </li>
                    <li class="nav-item m-4">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit"
                                class="btn btn-danger text-light rounded-5 nav-link p-1 shadow-sm fs-6 fw-bold w-100"><i
                                    class="fa-solid fa-right-from-bracket me-3"
                                    style="color: #ffffff;"></i>Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
            {{-- Side Nav Bar End --}}
            {{-- Main Panel Start --}}
            <div class="col-10">
                @yield('main-content')
            </div>
            {{-- Main Panel End --}}
        </div>
        {{-- Main Dashboard End --}}
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>

</html>
