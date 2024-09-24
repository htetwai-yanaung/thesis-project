@extends('template::layouts.master')

@section('content')
{{-- <section class="slider-one" style="padding-top: 80px;">
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
  </section> --}}
  <section class="slider-one" style="">
    <article class="owl-carousel owl-theme slide-1">
      @foreach ($bannerImages as $bannerImage)
          <div class="item" style="height: 500px">
              <img src="{{ asset('storage/uploads/project/'.$bannerImage->path) }}" alt="" class="" >
          </div>
      @endforeach
    </article>
  </section>

  <section class="news">
    <div class="container position-relative">
      <div class="flex-wrap gap-4 px-3 py-5 d-flex justify-content-center align-items-start">
        <article class="left col-12 col-lg-7">
          <h5 class="mb-3 text-primary fw-bold"><span class="text-info">Up to Date</span> News in our Department</h5>
          <div class="grid-system">
            @foreach ($allNews as $news)
                <a href="{{ route('news#detail', $news->id) }}" class="item">
                    @if ($news->images->count() > 0)
                        <x-image src="{{ 'storage/uploads/news/'.$news->images[0]->path }}" class="w-100 h-100 object-fit-cover"/>
                    @endif
                    <div class="px-2 py-3 text-white title">{{ $news->title }}</div>
                </a>
            @endforeach
          </div>
          <div class="mt-2 text-end">
            <a href="{{ route('news') }}" class="text-info text-decoration-none">See More...</a>
          </div>
        </article>
        <article class="right col-12 col-lg-4">
          <h5 class="mb-3 text-primary fw-bold">Thesis Projects</h5>
          <div class="project-container">

                @foreach ($latestProjects as $project)
                <article class="px-4 py-3 project-post">
                    <a href="{{ route('thesis#detail', $project->id) }}" class="text-decoration-none">
                        <h6 class="title text-info">{{ $project->title }}</h6>
                        <p class="p-0 m-0 description text-secondary">{!! Str::limit($project->description, 250, '...') !!}</p>
                        <div class="flex-wrap mt-2 d-flex justify-content-between align-items-center">
                            <div class="gap-2 d-flex align-items-center">
                                <x-image
                                    src="{{ 'storage/uploads/profile/'.$project->owner->profile_photo_path }}"
                                    default="images/images.png"
                                    class="object-fit-cover rounded-circle"
                                    style="width: 28px; height: 28px;"/>
                                <span class="name text-secondary">{{ $project->owner->name }}</span>
                            </div>
                            <span class="date text-secondary">{{ $project->created_at->format('d/m/Y') }}</span>
                        </div>
                    </a>
                </article>
                @endforeach

            <div class="mt-2 text-end">
              <a href="{{ route('thesis#page') }}" class="text-info text-decoration-none">See More...</a>
            </div>
          </div>
        </article>
        <div class="bottom-0 mx-auto divider col-6 bg-primary position-absolute" style="height: 3px;left: 0;right: 0;"></div>
      </div>
    </div>
  </section>

  <section class="projects">
    <div class="container position-relative">
      <div class="py-5 mx-3">
        <h3 class="text-center text-info">Popular Thesis Projects</h3>
        <h3 class="text-center text-primary">in Our Department</h3>
        <div class="mt-5 post-con">
            @if ($popularProjects[0])
            <div class="post-one">
              <div class="flex-wrap gap-4 d-flex justify-content-center align-items-start">
                <x-image src="{{ 'storage/uploads/project/' }}{{ count($popularProjects[0]->images) > 0 ? $popularProjects[0]->images[0]->path : 'no' }}" class="img-fluid object-fit-cover" style="width: 225px; height: 225px;"/>
                <div class="col-12 col-md-7">
                  <h5 class="title fw-bold text-primary">{{ $popularProjects[0]->title }}</h5>
                  <p class="description text-secondary">{!! Str::limit($popularProjects[0]->description, 250, '...') !!}</p>
                  <div class="">
                    <div class="project-type text-info">{{ $popularProjects[0]->category?->name }}</div>
                    <p class="date text-secondary">{{ $popularProjects[0]->created_at->format('d/m/Y') }}</p>
                  </div>
                  <a href="{{ route('thesis#detail', $popularProjects[0]->id) }}" class="btn btn-primary">See Details</a>
                </div>
              </div>
            </div>
            @endif
            @if ($popularProjects[1])
            <div class="my-5 post-two">
              <div class="flex-wrap gap-4 d-flex justify-content-center align-items-start flex-md-row-reverse">
                <x-image src="{{ 'storage/uploads/project/' }}{{ count($popularProjects[1]->images) > 0 ? $popularProjects[1]->images[0]->path : 'no' }}" class="img-fluid object-fit-cover" style="width: 225px; height: 225px;"/>
                <div class="col-12 col-md-7">
                  <h5 class="title fw-bold text-primary">{{ $popularProjects[1]->title }}</h5>
                  <p class="description text-secondary">{!! Str::limit($popularProjects[1]->description, 250, '...') !!}</p>
                  <div class="">
                    <div class="project-type text-info">{{ $popularProjects[2]->category?->name }}</div>
                    <p class="date text-secondary">{{ $popularProjects[2]->created_at->format('d/m/Y') }}</p>
                  </div>
                  <a href="{{ route('thesis#detail', $popularProjects[1]->id) }}" class="btn btn-primary">See Details</a>
                </div>
              </div>
            </div>
            @endif
            @if ($popularProjects[2])
            <div class="post-three">
              <div class="flex-wrap gap-4 d-flex justify-content-center align-items-start">
                <x-image src="{{ 'storage/uploads/project/' }}{{ count($popularProjects[2]->images) > 0 ? $popularProjects[2]->images[0]->path : 'no' }}" class="img-fluid object-fit-cover" style="width: 225px; height: 225px;"/>
                <div class="col-12 col-md-7">
                  <h5 class="title fw-bold text-primary">{{ $popularProjects[2]->title }}</h5>
                  <p class="description text-secondary">{!! Str::limit($popularProjects[2]->description, 250, '...') !!}</p>
                  <div class="">
                    <div class="project-type text-info">{{ $popularProjects[2]->category?->name }}</div>
                    <p class="date text-secondary">{{ $popularProjects[2]->created_at->format('d/m/Y') }}</p>
                  </div>
                  <a href="{{ route('thesis#detail', $popularProjects[2]->id) }}" class="btn btn-primary">See Details</a>
                </div>
              </div>
            </div>
            @endif
        </div>
        <div class="mt-5 text-center">
          <a href="{{ route('thesis#page') }}" class="btn text-info btn-outline-primary">
            <i class="fa-solid fa-arrow-right me-2"></i>
            Explore more
          </a>
        </div>
        <div class="bottom-0 mx-auto divider col-6 bg-primary position-absolute" style="height: 3px;left: 0;right: 0;"></div>
      </div>
    </div>
  </section>

  <section class="teacher-lists">
    <div class="container px-3 py-5 position-relative">
      <h5 class="pt-3 mb-3 text-center text-primary"><span class="text-info">Teachers</span> in Our Department</h5>
      <div class="mx-auto col-12 col-md-10 col-lg-8">
        <article class="pb-3 owl-carousel owl-theme slide-2 position-relative">
          @foreach ($teachers as $teacher)
            <div class="item">
              <div class="pt-3 d-flex justify-content-center align-items-center">
                <div class="">
                  <img src="@if ($teacher->profile_photo_path == null)
                    {{ asset('images/images.png') }}
                  @else
                    {{ asset('storage/uploads/profile/'.$teacher->profile_photo_path) }}
                  @endif" alt="" class="mx-auto rounded-circle" style="width: 100px;height: 100px;">
                  <h6 class="text-primary">{{ $teacher->name }}</h6>
                  {{-- <p class="text-secondary">Teacher</p> --}}
                </div>
              </div>
            </div>

          @endforeach
        </article>
      </div>
      <div class="bottom-0 mx-auto divider col-6 bg-primary position-absolute" style="height: 3px;left: 0;right: 0;"></div>
    </div>
  </section>

  <section class="d-none activity">
    <div class="container">
      <div class="px-3 py-5">
        <h5 class="text-center text-primary"><span class="text-info">Activities</span> in Our Department</h5>
        <div class="mx-auto mt-4 grid-system col-12 col-lg-10">
          <div class="item">
            <div class="px-2 py-3 text-white title">Title</div>
          </div>
          <div class="item">
            <div class="px-2 py-3 text-white title">Title</div>
          </div>
          <div class="item">
            <div class="px-2 py-3 text-white title">Title</div>
          </div>
          <div class="item">
            <div class="px-2 py-3 text-white title">Title</div>
          </div>
          <div class="item">
            <div class="px-2 py-3 text-white title">Title</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="contact-us">
    <div class="container">
      <div class="px-3">
        <div class="flex-wrap d-flex">
          <div class="col-12 col-md-6">
            <div class="py-5 d-flex align-items-center justify-content-md-center justify-content-start">
              <div class="">
                <h5 class="mb-3 text-primary">Contact Us</h5>
                <div class="location text-secondary">
                  <i class="fa-solid fa-location-dot"></i>
                  <span class="ms-2">Sagaing, Myanmar</span>
                </div>
                <div class="my-2 mail text-secondary">
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

@endsection
