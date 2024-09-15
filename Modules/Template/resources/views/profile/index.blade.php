@extends('template::layouts.master')
@section('content')
<section class="profile text-primary" style="padding-top: 80px">
    <div class="container gap-4 d-flex align-items-center">
        <div class="pt-5" id="img_preview">
            <x-image
                class="rounded-circle img-thumbnail"
                src="{{ 'storage/uploads/profile/'. Auth::user()->profile_photo_path }}"
                default="images/images.png" />
        </div>
        <div class="mt-5">
        <h6 class="fw-bold">Mg Tect Htun</h6>
        <span>VI-BE Student</span>
        </div>
        <!-- <div class="container mx-auto d-flex justify-content-end" >

          </div> -->
        <div class="mt-5 thesis-create justify-content-end" id="">
            <a href=""><button type="button" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i><span class="">Post your thesis</span></button></a>
        </div>

    </div>
    <div class="p-4 shadow-md">
        <ul class="list-unstyled">
            @if (count($thesisProjects) > 0)
                @foreach ($thesisProjects as $project)
                <li class="post">
                    <a href="{{ route('thesis#detail', $project->id) }}" class="text-decoration-none text-secondary">
                        <h4 class="title fw-bold">{{ $project->title }}</h4>
                        <div class="d-flex gap-3">
                            <div>
                                <p class="text-secondary ck-content">{!! Str::limit($project->description, 400, '...') !!}</p>
                            </div>
                            <x-image
                                class="post-image"
                                src="{{ 'storage/uploads/project/'. $project->images[0]->path }}"
                                default="images/default-image.jpg" />
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-info"></span>
                            <span>{{ $project->created_at->format('d/m/Y') }}</span>
                        </div>
                    </a>
                </li>
                @endforeach
            @else
                No Post
            @endif

        </ul>
        {{ $thesisProjects->links() }}
    </div>
</section>
@endsection
