@extends('template::layouts.master')
@section('content')
<section class="profile text-primary" style="padding-top: 80px">
    <div class="container gap-4 d-flex align-items-center">

        <div class="" id="img_preview" style="width: 200px; height: 200px;">
            <x-image
                class="w-100 h-100 object-fit-cover rounded-circle img-thumbnail"
                src="{{ 'storage/uploads/profile/'. $user->profile_photo_path }}"
                default="images/images.png" />
        </div>

        <div class="mt-5">
        <h6 class="fw-bold">{{ $user->name }}</h6>
        <span>{{ $user->userYear?->year }}</span>
        </div>
        <!-- <div class="container mx-auto d-flex justify-content-end" >

        </div> -->
        @if ($user->id == Auth::id())
        <div class="mt-5 thesis-create justify-content-end" id="" >
            <a href="{{ route('user.thesis.create') }}"><button type="button" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i><span class="">Post your thesis</span></button></a>
        </div>
        @endif

    </div>
    <div class="p-4 shadow-md">
        <ul class="list-unstyled">
            @if (count($thesisProjects) > 0)
                @foreach ($thesisProjects as $project)
                <li class="post">
                    <a href="{{ route('thesis#detail', $project->id) }}" class="text-decoration-none text-secondary">
                        <h4 class="title fw-bold">{{ $project->title }}</h4>
                        <div class="d-flex gap-3 h-100">
                            <div class="d-flex flex-column justify-content-between">
                                <p class="text-secondary ck-content">{!! Str::limit($project->description, 400, '...') !!}</p>
                                <div class="d-flex justify-content-between">
                                    <span class="text-info">Popularity: {{ $project->popular_count }}</span>
                                    <span>{{ $project->created_at->format('d/m/Y') }}</span>
                                </div>
                            </div>
                            <x-image
                                class="post-image"
                                src="{{ 'storage/uploads/project/' }}{{ count($project->images) > 0 ? $project->images[0]->path : 'no' }}"
                                default="images/default-image.jpg" />
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
