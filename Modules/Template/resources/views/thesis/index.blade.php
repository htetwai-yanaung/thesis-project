@extends('template::layouts.master')

@section('content')

    {{-- <div class="container mx-3 post d-flex justify-content-end" style="padding-top: 120px;">
    <div class="left col-12 col-lg-2">
      <a href="#"><button type="button" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i>Post your thesis</button></a>
    </div>
    </div> --}}
    <div class="container" style="margin-top: 20px;">
        <div class="container-fluid pt-3">
            <div class="row row-cols-4 gy-3">
                @foreach ($thesisProjects as $project)
                <div class="col">
                    <div class="card" style="height: 500px;">
                        <div class="card-header bg-primary d-flex align-items-center gap-2">
                            <div class="rounded-circle border border-white" style="width: 40px; height: 40px;">
                                <x-image src="{{ 'storage/uploads/profile/'.$project->owner->profile_photo_path }}" class="h-100 w-100 rounded-circle" style="object-fit: cover"/>
                            </div>
                            <h6 class="text-white">{{ $project->owner->name }}</h6>
                        </div>
                        <div class="" style="height: 200px;">
                            <x-image src="{{ 'storage/uploads/project/'.$project->images[0]->path }}" class="card-img-top h-100 w-100" style="object-fit: cover"/>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $project->title }}</h5>
                            <p class="card-text">{!! Str::limit($project->description, 100, '...') !!}</p>
                            <a href="{{ route('thesis#detail', $project->id) }}" class="btn btn-primary align-self-end mt-auto">See more</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        {{-- <div class="position-relative">
            <div class="flex-wrap gap-4 px-3 py-5 d-flex justify-content-center align-items-start">
                <article class="left col-12 col-lg-7">
                    <h5 class="mb-3 text-primary fw-bold"><span class="text-info">Thesis</span> in our Department</h5>
                    <ul style="list-style-type: none;">
                        <hr class="mt-0">
                        @foreach ($thesisProjects as $project)
                            <li class="" style="margin: 5px; padding: 10px;">
                                <h4 class="title fw-bold text-primary">{{ $project->title }}</h4>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="description text-secondary">{!! Str::limit($project->description, 200, '...') !!}</p>
                                    </div>
                                    <x-image src="{{ 'storage/uploads/project/'.$project->images[0]->path }}" class="thesis-image"/>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="text-info">{{ $project->owner->name }}</span>
                                    <span>{{ $project->created_at->format('d/m/Y') }}</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </article>
                <div class="bottom-0 mx-auto divider col-6 bg-primary position-absolute" style="height: 3px;left: 0;right: 0;"></div>
            </div>
        </div> --}}
        <div class="d-flex justify-content-center mt-3">
            {{ $thesisProjects->links() }}
        </div>
    </div>
@endsection
