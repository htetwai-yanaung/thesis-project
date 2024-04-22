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
    <script src="{{ asset( 'js/bootstrap.min.js' ) }}"></script>
</head>

<body>
    <section class="main">

        <nav class="navbar navbar-expand-lg navbar-light bg-light container-fluid position-fixed" id="navbar">
          <div class="container">
            <a class="navbar-brand" href="#">
              <div class="d-flex align-items-center text-info fw-bold">
                <img src="./Images/Logo.png" alt="" class="">
                EC Department
              </div>
            </a>
            <button class="navbar-toggler text-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <ul class="navbar-nav ms-auto gap-3">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">News</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Projects</a>
                </li>
              </ul>
              <ul class="navbar-nav ms-auto gap-2">
                <li class="nav-item">
                  <div class="nav-link" style="cursor: pointer;">
                    <span class=" d-none" id="moon">Theme<i class="fa-solid fa-moon ms-2"></i></span>
                    <span class="" id="sun">Theme<i class="fa-solid fa-sun ms-2"></i></span>
                  </div>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}">Sign In</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link btn btn-primary text-white d-inline d-lg-block" href="{{ route('register') }}">Get Start</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>

        <section class="slider-one" style="padding-top: 80px;">
          <article class="owl-carousel owl-theme slide-1">
            <div class="item">
              <img src="storage/uploads/Rectangle_1.png" alt="" class="">
            </div>
            <div class="item">
              <img src="storage/uploads/Rectangle_1.png" alt="" class="">
            </div>
            <div class="item">
              <img src="storage/uploads/Rectangle_1.png" alt="" class="">
            </div>
          </article>
        </section>

        <section class="news">
          <div class="container position-relative">
            <div class=" py-5 px-3 d-flex justify-content-center align-items-start flex-wrap gap-4">
              <article class="left col-12 col-lg-7">
                <h5 class="text-primary mb-3 fw-bold"><span class="text-info">Up to Date</span> News in our Department</h5>
                <div class="grid-system">
                  <a href="#" class="item">
                    <div class="title px-2 py-3 text-white">Title</div>
                  </a>
                  <a href="#" class="item">
                    <div class="title px-2 py-3 text-white">Title</div>
                  </a>
                  <a href="#" class="item">
                    <div class="title px-2 py-3 text-white">Title</div>
                  </a>
                  <a href="#" class="item">
                    <div class="title px-2 py-3 text-white">Title</div>
                  </a>
                  <a href="#" class="item">
                    <div class="title px-2 py-3 text-white">Title</div>
                  </a>
                  <a href="#" class="item">
                    <div class="title px-2 py-3 text-white">Title</div>
                  </a>
                </div>
                <div class="text-end mt-2">
                  <a href="" class="text-info text-decoration-none">See More...</a>
                </div>
              </article>
              <article class="right col-12 col-lg-4">
                <h5 class="text-primary fw-bold mb-3">Thesis Projects</h5>
                <div class="project-container">
                  <article class="project-post px-4 py-3">
                    <a href="" class="text-decoration-none">
                      <h6 class="title text-info">Title</h6>
                    <p class="description text-secondary m-0 p-0">Lorem ipsum dolor sit amet, consectr adipiscing elit, sed do eiusmod tempor . . .</p>
                    <div class="d-flex justify-content-between align-items-center flex-wrap mt-2">
                      <div class="d-flex align-items-center gap-2">
                        <img src="storage/uploads/Rectangle_2.png" alt="" class="rounded-circle" style="width: 28px;">
                        <span class="name text-secondary">Mg Tect Htun</span>
                      </div>
                      <span class="date text-secondary">02.03.2024</span>
                    </div>
                    </a>
                  </article>
                  <article class="project-post px-4 py-3">
                    <a href="" class="text-decoration-none">
                      <h6 class="title text-info">Title</h6>
                    <p class="description text-secondary m-0 p-0">Lorem ipsum dolor sit amet, consectr adipiscing elit, sed do eiusmod tempor . . .</p>
                    <div class="d-flex justify-content-between align-items-center flex-wrap mt-2">
                      <div class="d-flex align-items-center gap-2">
                        <img src="storage/uploads/Rectangle_2.png" alt="" class="rounded-circle" style="width: 28px;">
                        <span class="name text-secondary">Mg Tect Htun</span>
                      </div>
                      <span class="date text-secondary">02.03.2024</span>
                    </div>
                    </a>
                  </article>
                  <article class="project-post px-4 py-3">
                    <a href="" class="text-decoration-none">
                      <h6 class="title text-info">Title</h6>
                    <p class="description text-secondary m-0 p-0">Lorem ipsum dolor sit amet, consectr adipiscing elit, sed do eiusmod tempor . . .</p>
                    <div class="d-flex justify-content-between align-items-center flex-wrap mt-2">
                      <div class="d-flex align-items-center gap-2">
                        <img src="storage/uploads/Rectangle_2.png" alt="" class="rounded-circle" style="width: 28px;">
                        <span class="name text-secondary">Mg Tect Htun</span>
                      </div>
                      <span class="date text-secondary">02.03.2024</span>
                    </div>
                    </a>
                  </article>
                  <article class="project-post px-4 py-3">
                    <a href="" class="text-decoration-none">
                      <h6 class="title text-info">Title</h6>
                    <p class="description text-secondary m-0 p-0">Lorem ipsum dolor sit amet, consectr adipiscing elit, sed do eiusmod tempor . . .</p>
                    <div class="d-flex justify-content-between align-items-center flex-wrap mt-2">
                      <div class="d-flex align-items-center gap-2">
                        <img src="storage/uploads/Rectangle_2.png" alt="" class="rounded-circle" style="width: 28px;">
                        <span class="name text-secondary">Mg Tect Htun</span>
                      </div>
                      <span class="date text-secondary">02.03.2024</span>
                    </div>
                    </a>
                  </article>
                  <article class="project-post px-4 py-3">
                    <a href="" class="text-decoration-none">
                      <h6 class="title text-info">Title</h6>
                    <p class="description text-secondary m-0 p-0">Lorem ipsum dolor sit amet, consectr adipiscing elit, sed do eiusmod tempor . . .</p>
                    <div class="d-flex justify-content-between align-items-center flex-wrap mt-2">
                      <div class="d-flex align-items-center gap-2">
                        <img src="./storage/uploads/Rectangle_2.png" alt="" class="rounded-circle" style="width: 28px;">
                        <span class="name text-secondary">Mg Tect Htun</span>
                      </div>
                      <span class="date text-secondary">02.03.2024</span>
                    </div>
                    </a>
                  </article>
                  <div class="text-end mt-2">
                    <a href="" class="text-info text-decoration-none">See More...</a>
                  </div>
                </div>
              </article>
              <div class="divider col-6 mx-auto bg-primary position-absolute bottom-0" style="height: 3px;left: 0;right: 0;"></div>
            </div>
          </div>
        </section>

        <section class="projects">
          <div class="container position-relative">
            <div class="py-5 mx-3">
              <h3 class="text-center text-info">Popular Thesis Projects</h3>
              <h3 class="text-center text-primary">in Our Department</h3>
              <div class="post-con mt-5">
                <div class="post-one">
                  <div class="d-flex justify-content-center align-items-start flex-wrap gap-4">
                    <img src="./storage/uploads/Rectangle_2.png" alt="" class="img-fluid">
                    <div class="col-12 col-md-7">
                      <h5 class="title fw-bold text-primary">Automatic Robotic Arm</h5>
                      <p class="description text-secondary">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse . . .</p>
                      <div class="">
                        <div class="project-type text-info">Third Year Group I Projects</div>
                        <p class="date text-secondary">03.02.2024</p>
                      </div>
                      <div class="btn btn-primary">See Details</div>
                    </div>
                  </div>
                </div>
                <div class="post-two my-5">
                  <div class="d-flex justify-content-center align-items-start flex-md-row-reverse flex-wrap gap-4">
                    <img src="./storage/uploads/Rectangle_2.png" alt="" class="img-fluid">
                    <div class="col-12 col-md-7">
                      <h5 class="title fw-bold text-primary">Automatic Robotic Arm</h5>
                      <p class="description text-secondary">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse . . .</p>
                      <div class="">
                        <div class="project-type text-info">Third Year Group I Projects</div>
                        <p class="date text-secondary">03.02.2024</p>
                      </div>
                      <div class="btn btn-primary">See Details</div>
                    </div>
                  </div>
                </div>
                <div class="post-three">
                  <div class="d-flex justify-content-center align-items-start flex-wrap gap-4">
                    <img src="./storage/uploads/Rectangle_2.png" alt="" class="img-fluid">
                    <div class="col-12 col-md-7">
                      <h5 class="title fw-bold text-primary">Automatic Robotic Arm</h5>
                      <p class="description text-secondary">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse . . .</p>
                      <div class="">
                        <div class="project-type text-info">Third Year Group I Projects</div>
                        <p class="date text-secondary">03.02.2024</p>
                      </div>
                      <div class="btn btn-primary">See Details</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-center mt-5">
                <div class="btn text-info btn-outline-primary">
                  <i class="fa-solid fa-arrow-right me-2"></i>
                  Explore more
                </div>
              </div>
              <div class="divider col-6 mx-auto bg-primary position-absolute bottom-0" style="height: 3px;left: 0;right: 0;"></div>
            </div>
          </div>
        </section>

        <section class="teacher-lists">
          <div class="container px-3 py-5 position-relative">
            <h5 class="text-center text-primary mb-3 pt-3"><span class="text-info">Teachers</span> in Our Department</h5>
            <div class="col-12 col-md-10 col-lg-8 mx-auto">
              <article class="owl-carousel owl-theme slide-2 position-relative pb-3">
                <div class="item">
                  <div class="d-flex justify-content-center align-items-center pt-3">
                    <div class="">
                      <img src="storage/uploads/Ellipse 4.png" alt="" class="rounded-circle mx-auto" style="width: 100px;height: 100px;">
                      <h6 class="text-primary">U Aung Kyaw Moe</h6>
                      <p class="text-secondary">Role</p>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="d-flex justify-content-center align-items-center pt-3">
                    <div class="">
                      <img src="storage/uploads/Ellipse 4.png" alt="" class="rounded-circle mx-auto" style="width: 100px;height: 100px;">
                      <h6 class="text-primary">U Aung Kyaw Moe</h6>
                      <p class="text-secondary">Role</p>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="d-flex justify-content-center align-items-center pt-3">
                    <div class="">
                      <img src="storage/uploads/Ellipse 4.png" alt="" class="rounded-circle mx-auto" style="width: 100px;height: 100px;">
                      <h6 class="text-primary">U Aung Kyaw Moe</h6>
                      <p class="text-secondary">Role</p>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="d-flex justify-content-center align-items-center pt-3">
                    <div class="">
                      <img src="storage/uploads/Ellipse 4.png" alt="" class="rounded-circle mx-auto" style="width: 100px;height: 100px;">
                      <h6 class="text-primary">U Aung Kyaw Moe</h6>
                      <p class="text-secondary">Role</p>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="d-flex justify-content-center align-items-center pt-3">
                    <div class="">
                      <img src="storage/uploads/Ellipse 4.png" alt="" class="rounded-circle mx-auto" style="width: 100px;height: 100px;">
                      <h6 class="text-primary">U Aung Kyaw Moe</h6>
                      <p class="text-secondary">Role</p>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="d-flex justify-content-center align-items-center pt-3">
                    <div class="">
                      <img src="storage/uploads/Ellipse 4.png" alt="" class="rounded-circle mx-auto" style="width: 100px;height: 100px;">
                      <h6 class="text-primary">U Aung Kyaw Moe</h6>
                      <p class="text-secondary">Role</p>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="d-flex justify-content-center align-items-center pt-3">
                    <div class="">
                      <img src="storage/uploads/Ellipse 4.png" alt="" class="rounded-circle mx-auto" style="width: 100px;height: 100px;">
                      <h6 class="text-primary">U Aung Kyaw Moe</h6>
                      <p class="text-secondary">Role</p>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="d-flex justify-content-center align-items-center pt-3">
                    <div class="">
                      <img src="storage/uploads/Ellipse 4.png" alt="" class="rounded-circle mx-auto" style="width: 100px;height: 100px;">
                      <h6 class="text-primary">U Aung Kyaw Moe</h6>
                      <p class="text-secondary">Role</p>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="d-flex justify-content-center align-items-center pt-3">
                    <div class="">
                      <img src="storage/uploads/Ellipse 4.png" alt="" class="rounded-circle mx-auto" style="width: 100px;height: 100px;">
                      <h6 class="text-primary">U Aung Kyaw Moe</h6>
                      <p class="text-secondary">Role</p>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="d-flex justify-content-center align-items-center pt-3">
                    <div class="">
                      <img src="storage/uploads/Ellipse 4.png" alt="" class="rounded-circle mx-auto" style="width: 100px;height: 100px;">
                      <h6 class="text-primary">U Aung Kyaw Moe</h6>
                      <p class="text-secondary">Role</p>
                    </div>
                  </div>
                </div>
              </article>
            </div>
            <div class="divider col-6 mx-auto bg-primary position-absolute bottom-0" style="height: 3px;left: 0;right: 0;"></div>
          </div>
        </section>

        <section class="activity">
          <div class="container">
            <div class="py-5 px-3">
              <h5 class="text-primary text-center"><span class="text-info">Activities</span> in Our Department</h5>
              <div class="grid-system col-12 col-lg-10 mx-auto mt-4">
                <div class="item">
                  <div class="title px-2 py-3 text-white">Title</div>
                </div>
                <div class="item">
                  <div class="title px-2 py-3 text-white">Title</div>
                </div>
                <div class="item">
                  <div class="title px-2 py-3 text-white">Title</div>
                </div>
                <div class="item">
                  <div class="title px-2 py-3 text-white">Title</div>
                </div>
                <div class="item">
                  <div class="title px-2 py-3 text-white">Title</div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <section class="contact-us">
          <div class="container">
            <div class="px-3">
              <div class="d-flex flex-wrap">
                <div class="col-12 col-md-6">
                  <div class="d-flex align-items-center justify-content-md-center justify-content-start py-5">
                    <div class="">
                      <h5 class="text-primary mb-3">Contact Us</h5>
                      <div class="location text-secondary">
                        <i class="fa-solid fa-location-dot"></i>
                        <span class="ms-2">Sagaing, Myanmar</span>
                      </div>
                      <div class="mail text-secondary my-2">
                        <i class="fa-solid fa-envelope"></i>
                        <span class="ms-2">ECdepartment@gmail.com</span>
                      </div>
                      <div class="phone text-secondary">
                        <i class="fa-solid fa-phone"></i>
                        <span class="ms-2">09 982232373, 09 976745800</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3701.2852955943604!2d95.95182417542819!3d21.92358105644437!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30cb0e3bca42881b%3A0xe9cde11970f1fb66!2sSagaing%20Technological%20University!5e0!3m2!1sen!2smm!4v1712119335962!5m2!1sen!2smm" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="w-100 h-100"></iframe>
                </div>
              </div>
            </div>
          </div>
        </section>

        <section class="footer">
          <div class="container-fluid bg-primary py-3 px-2">
            <h6 class="text-white text-center">
              Copyright
              <i class="fa-solid fa-copyright"></i>
              Designed by Geeky Dev
            </h6>
          </div>
        </section>

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
