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
    <link rel="stylesheet" href="{{ asset( 'css/bootstrap.min.css' ) }}">
    <link rel="stylesheet" href="{{ asset( 'css/custom.css' ) }}">
    {{-- <link rel="stylesheet" href="{{asset('css/all.css')}}"> --}}

    <script src="{{ asset( 'js/bootstrap.bundle.min.js' ) }}"></script>
    <script src="{{asset('js/all.js')}}"></script>
</head>

<body class="light-mood">
    <section class="main">

        <nav class="navbar navbar-expand-lg navbar-light bg-light container-fluid position-fixed" id="navbar">
          <div class="container">
            <a class="navbar-brand" href="#">
              <div class="d-flex align-items-center text-info fw-bold">
                <img src="storage/uploads/logo.png" alt="" class="">
                EC Department
              </div>
            </a>
            <button class="navbar-toggler text-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <ul class="gap-3 navbar-nav ms-auto">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('news')}}">News</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('thesis#page')}}">Projects</a>
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
                <li class="nav-item dropdown bgsucc">
                  <a class="nav-link dropdown-toggle" href="#" id="user_name" role="button"
                      data-bs-toggle="dropdown" aria-expanded="false">
                      <img src="storage/uploads/Ellipse 4.png" alt="" class="me-2 rounded-circle"
                          style="width: 40px; height: 40px" />
                      Mg Tect Htun
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="user_name">
                      <li class="dropdown-item">
                        <i class="fa-solid fa-user"></i>
                        <a class="mx-2 text-decoration-none" href="{{route('profile')}}"><span class="text-dark">Profile</span></a>

                      </li>
                      <li class="dropdown-item">
                        <i class="fa-solid fa-gear"></i>
                        <a class="mx-2 text-decoration-none" href="{{route('profile#setting')}}"><span class="text-dark">Setting</span></a>

                      </li>
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

        <section class="slider-one" style="padding-top: 56px;">
          <article class="owl-carousel owl-theme slide-1">
            @foreach ($bannerImages as $bannerImage)
                <div class="item">
                    <img src="{{ asset('storage/uploads/project/'.$bannerImage->path) }}" alt="" class="">
                </div>
            @endforeach
          </article>
        </section>


        @yield('content')

      </section>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

          // switch theme
          document.getElementById('sun').addEventListener('click',()=>{
            document.body.classList.toggle('light-mood');
            document.body.classList.toggle('dark-mood');
            document.getElementById('moon').classList.remove('d-none');
            document.getElementById('sun').classList.add('d-none');
            document.getElementById('navbar').classList.toggle('navbar-light');
            document.getElementById('navbar').classList.toggle('navbar-dark');
            document.getElementById('navbar').classList.toggle('bg-light');
            document.getElementById('navbar').classList.toggle('bg-dark');

          })
          document.getElementById('moon').addEventListener('click',()=>{
            document.body.classList.toggle('dark-mood');
            document.body.classList.toggle('light-mood');
            document.getElementById('sun').classList.remove('d-none');
            document.getElementById('moon').classList.add('d-none');
            document.getElementById('navbar').classList.toggle('navbar-light');
            document.getElementById('navbar').classList.toggle('navbar-dark');
            document.getElementById('navbar').classList.toggle('bg-light');
            document.getElementById('navbar').classList.toggle('bg-dark');

          })

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
