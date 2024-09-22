@extends('template::layouts.master')
@section('content')

<div class="container pt-3" style="margin-top: 20px;">
    <h5 class="mb-3 text-primary fw-bold"><span class="text-info">Up to Date News</span> in our Department</h5>
    <div class="row">
        @foreach ($allNews as $news)
        <div class="col-md-9 col-sm-12">
            <div class="border border-end-0 border-start-0 p-3 row">
                <div class="col-6 col-lg-8 text-secondary d-flex flex-column justify-content-between">
                    <div class="">
                        <h4 class="title fw-bold text-primary">{{ $news->title }}</h4>
                        <p>
                            {!! Str::limit($news->description, 200, '...') !!}
                        </p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('news#detail', $news->id) }}" class="btn btn-outline-primary rounded-start-5 rounded-end-5">See more</a>
                        <span>{{ $news->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
                <div class="col-6 col-lg-4" style="widht: 200px; height: 200px">
                    <x-image src="{{ 'storage/uploads/news/'.$news->images[0]->path }}" class="w-100 h-100 object-fit-cover rounded"/>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-3">
        {{ $allNews->links() }}
    </div>
</div>
@endsection
