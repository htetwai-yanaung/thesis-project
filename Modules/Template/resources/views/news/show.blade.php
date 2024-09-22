@extends('template::layouts.master')

@section('content')
<div class="container pt-3" style="margin-top: 20px;">
    <div class="row">
        <div class="col-4">
            @foreach ($news->images as $image)
            <div class="mb-3">
                <x-image src="{{ 'storage/uploads/news/'.$image->path }}" class="w-100 h-100 object-fit-cover rounded"/>
            </div>
            @endforeach
        </div>
        <div class="col-8">
            <div class="">
                <h4 class="title fw-bold text-primary">{{ $news->title }}</h4>
                <div class="mb-3">Date: {{ $news->created_at->format('d/m/Y') }}</div>
                <div class="text-secondary"> {!! $news->description !!} </div>
            </div>
        </div>
    </div>
</div>
@endsection
