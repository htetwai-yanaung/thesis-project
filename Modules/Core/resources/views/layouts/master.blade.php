<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Core Module - {{ config('app.name', 'Laravel') }}</title>

    <meta name="description" content="{{ $description ?? '' }}">
    <meta name="keywords" content="{{ $keywords ?? '' }}">
    <meta name="author" content="{{ $author ?? '' }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.green.min.css" integrity="sha512-C8Movfk6DU/H5PzarG0+Dv9MA9IZzvmQpO/3cIlGIflmtY3vIud07myMu4M/NTPJl8jmZtt/4mC9bAioMZBBdA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset( 'css/bootstrap.min.css' ) }}">
    <link rel="stylesheet" href="{{ asset( 'css/custom.css' ) }}">
    <link rel="stylesheet" href="{{ asset( 'css/admin.css' ) }}">

    <link rel="stylesheet" href="{{asset('css/all.css')}}">
    <script src="{{ asset( 'js/bootstrap.min.js' ) }}"></script>
    <script src="{{ asset( 'js/bootstrap.bundle.min.js' ) }}"></script>
    <script src="{{asset('js/all.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{ asset( 'css/drag-and-drop.css' ) }}">


    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/basic.min.css" integrity="sha512-MeagJSJBgWB9n+Sggsr/vKMRFJWs+OUphiDV7TJiYu+TNQD9RtVJaPDYP8hA/PAjwRnkdvU+NsTncYTKlltgiw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" /> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
</head>

<body class="light-mood">
    {{-- @yield('content') --}}

    <div id="page-top">
        <div id="wrapper">
            <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center " href="index.html">
                    <div class="d-flex align-items-center text-info fw-bold">
                        <img src="{{ asset('storage/uploads/'.$siteImage) }}" alt="" class="">
                       <span>{{ $siteName }}</span>
                      </div>
                </a>

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="{{Route::current()->getName() == 'admin.dashboard' ? 'nav-link active' : 'nav-link'}}" href="{{ route('admin.dashboard') }}">
                        <i class="fa-solid fa-table-columns"></i>
                        <span>Dashboard</span></a>
                </li>
                <li class="nav-item active">
                    <a class="{{Route::current()->getName() == 'thesis.index' ? 'nav-link active' : 'nav-link'}}" href="{{ route('thesis.index') }}">
                        <i class="fa-solid fa-rectangle-list"></i>
                        <span>Thesis</span></a>
                </li>
                <li class="nav-item active">

                    <a class="{{Route::current()->getName() == 'announcement.index' ? 'nav-link active' : 'nav-link'}}" href="{{ route('announcement.index') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>

                        <span>News</span></a>
                </li>
                <li class="nav-item active">
                    <a class="{{Route::current()->getName() == 'teacher.index' ? 'nav-link active' : 'nav-link'}}" href="{{ route('teacher.index') }}">
                        <i class="fa-solid fa-user-group"></i>
                        <span>Teacher List</span></a>
                </li>
                <li class="nav-item active">
                    <a class="{{Route::current()->getName() == 'student.index' ? 'nav-link active' : 'nav-link'}}" href="{{ route('student.index') }}">
                        <i class="fa-solid fa-user-group"></i>
                        <span>Student List</span></a>
                </li>
                <li class="nav-item active">

                    <a class="{{Route::current()->getName() == 'settings.index' ? 'nav-link active' : 'nav-link'}}" href="{{ route('settings.index') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>

                        <span>Setting</span></a>
                </li>
                <li class="nav-item active">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="nav-link">
                            <a><i class="fa-solid fa-right-from-bracket text-danger"></i>
                            <span class="text-danger">Log Out</span></a>
                        </button>
                    </form>
                </li>
            </ul>
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="px-4 mb-4 bg-white shadow navbar navbar-expand navbar-light topbar static-top d-flex">



                        <!-- Topbar Navbar -->
                        @if (Auth::check())
                        <a href="{{ route('profile.edit', Auth::user()->id) }}" class="gap-2 navbar-nav ms-auto d-flex align-items-center text-decoration-none">

                            <!-- Nav Item - User Information -->

                            <div class="profile-pic">
                                <img src="{{ asset('storage/uploads/profile.png') }}" alt="">
                            </div>
                            <div class="">
                                <h6 class="fs-5 fw-bold text-secondary">{{ Auth::user()->name }}</h6>
                                <span class="fs-6 text-secondary">Super Admin</span>
                            </div>
                        </a>   
                        @else
                            <a href="{{route('thesis#detail')}}"></a>
                        @endif
                        

                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-success">
                    <div class="container my-auto">
                        <div class="my-auto text-center copyright">
                            <span>Copyright &copy; Geek Tect</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->
        </div>

    </div>


    <script src="{{ asset( 'js/bootstrap.bundle.js' ) }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    {{-- dropzone js --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.js" integrity="sha512-9e9rr82F9BPzG81+6UrwWLFj8ZLf59jnuIA/tIf8dEGoQVu7l5qvr02G/BiAabsFOYrIUTMslVN+iDYuszftVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/drag-and-drop.js') }}"></script>
    @yield('script')

</body>
