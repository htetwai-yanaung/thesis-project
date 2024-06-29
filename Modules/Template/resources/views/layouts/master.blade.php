<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Template Module - {{ config('app.name', 'Laravel') }}</title>

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
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset( 'css/bootstrap.min.css' ) }}">
    <link rel="stylesheet" href="{{ asset( 'css/custom.css' ) }}">
    {{-- <link rel="stylesheet" href="{{asset('css/all.css')}}"> --}}
    <link rel="stylesheet" href="{{ asset( 'css/ckeditor.css' ) }}">
    <link rel="stylesheet" href="{{ asset( 'css/drag-and-drop.css' ) }}">
</head>

<body class="light-mood">
    <section class="main">

        <nav class="navbar navbar-expand-lg navbar-light bg-light container-fluid position-fixed" id="navbar">
          <div class="container">
            <a class="navbar-brand" href="#">
              <div class="d-flex align-items-center text-info fw-bold gap-2">
                <div class="profile-pic">
                    <img src="{{ asset('storage/uploads/'.$siteImage) }}" alt="site-image" class="" >
                </div>
                <span>{{ $siteName }}</span>
              </div>
            </a>
            <button class="navbar-toggler text-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <ul class="gap-3 navbar-nav ms-auto">
                <li class="nav-item">
                  <a class="nav-link @if(Route::current()->getName() == 'dashboard') active @endif" aria-current="page" href="{{ route('dashboard') }}">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link @if(Route::current()->getName() == 'news') active @endif" href="{{ route('news') }}">News</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link @if(Route::current()->getName() == 'thesis#page') active @endif" href="{{ route('thesis#page') }}">Projects</a>
                </li>
              </ul>
              <ul class="gap-2 navbar-nav ms-auto">
                <li class="align-items-center d-flex nav-item">
                  <div class="nav-link" style="cursor: pointer;">
                    Theme
                    <span class=" d-none" id="moon"><i class="fa-solid fa-moon ms-2"></i></span>
                    <span class="" id="sun"><i class="fa-solid fa-sun ms-2"></i></span>
                  </div>
                </li>
                @if (Auth::check())
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="user_name" role="button"
                      data-bs-toggle="dropdown" aria-expanded="false">
                      <img src="{{ asset('images/images.png') }}" alt="" class="me-2 rounded-circle"
                          style="width: 40px; height: 40px" />
                      {{ Auth::user()->name }}
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="user_name">
                      <li class="dropdown-item">
                        <i class="fa-solid fa-user"></i>
                        <a class="mx-2 text-decoration-none" href="{{route('user.profile', Auth::user()->id)}}"><span class="text-dark">Profile</span></a>

                      </li>
                      <li class="dropdown-item">
                        <i class="fa-solid fa-gear"></i>
                        <a class="mx-2 text-decoration-none" href="{{route('user.profile.setting', Auth::user()->id)}}"><span class="text-dark">Setting</span></a>

                      </li>
                      @if (Auth::user()->role == 1)
                      <li class="dropdown-item">
                        <i class="fa-solid fa-gear"></i>
                        <a class="mx-2 text-decoration-none" href="{{route('admin.dashboard')}}"><span class="text-dark">Switch to Admin</span></a>

                      </li>
                      @endif
                      <li>
                          <hr class="dropdown-divider" />
                      </li>
                      <li class="dropdown-item">
                         <form action="{{route('logout')}}" method="POST">
                          @csrf
                          <button class="nav-link">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                          <span class="text-dark"> Log out</span>
                          </button>
                         </form>
                      </li>
                  </ul>
                </li>
                <li class="align-items-center d-flex nav-item">
                    <a href="{{ route('user.thesis.create') }}" class="btn btn-primary">Post</a>
                </li>
                @else
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}">Sign In</a>
                </li>
                <li class="nav-item">
                  <a class="text-white nav-link btn btn-primary d-inline d-lg-block" href="{{ route('register') }}">Get Start</a>
                </li>
                @endif
              </ul>
            </div>
          </div>
        </nav>


        @yield('content')

    </section>
    <section class="footer">
        <div class="px-2 py-3 container-fluid bg-primary">
          <h6 class="text-center text-white">
            Copyright
            <i class="fa-solid fa-copyright"></i>
            Designed by Geeky Dev
          </h6>
        </div>
      </section>
    <script src="{{ asset( 'js/bootstrap.bundle.min.js' ) }}"></script>
    <script src="{{asset('js/all.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor5/41.4.2/ckeditor.min.js" integrity="sha512-z5R1qDiHpqoswJJOldglYtCSpaDg3JUEoZL/M/4LDCL6XUwB2cHmCtzCXWcCbA3CCuGxTCxdKA9ybTJu2zqTng==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.js" integrity="sha512-9e9rr82F9BPzG81+6UrwWLFj8ZLf59jnuIA/tIf8dEGoQVu7l5qvr02G/BiAabsFOYrIUTMslVN+iDYuszftVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="{{ asset('js/drag-and-drop.js') }}"></script>
    @yield('script')
    <script>
        // navbar scroll
        var prevScrollpos = window.pageYOffset;
          window.onscroll = function() {
            var currentScrollPos = window.pageYOffset;
            if (prevScrollpos > currentScrollPos) {
              document.getElementById("navbar").style.top = "0px";
            } else {
              document.getElementById("navbar").style.top = "-80px";
            }
            prevScrollpos = currentScrollPos;
          }

            $(document).ready(function() {
            $('.slide-1').owlCarousel({

                  margin:10,
                  responsiveClass:true,
                  dots: true,
                  autoplay:true,
                  autoplayTimeout:5000,
                  autoplayHoverPause:true,
                  loop:true,
                  nav:false,
                  responsive:{
                      0:{
                          items:1,
                      },
                      768:{
                        items:1,
                      },
                      992:{
                        items:1,
                      },
                      1500:{
                        items:1,
                      }
                  }
              })
            });

            $(document).ready(function() {
            $('.slide-2').owlCarousel({

                  margin:10,
                  responsiveClass:true,
                  nav:true,
                  dots: false,
                  autoplay:true,
                  autoplayTimeout:5000,
                  autoplayHoverPause:true,
                  loop:true,
                  responsive:{
                      0:{
                          items:1,
                      },
                      687:{
                        items:2
                      },
                      768:{
                        items:3,
                      },
                      999:{
                        items:4,
                      },
                      1500:{
                        items:5,
                      }
                  }
              })
            });
      </script>
</body>
