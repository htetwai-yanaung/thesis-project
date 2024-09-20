@extends('template::layouts.master')
@section('content')
<div class="post-detail light-mood" id="detail" style="padding-top: 120px;">
    <div class="row">
        @foreach ($thesisProject->images as $image)
            <div class="column">
                <x-image class="img-fluid"
                    src="{{ 'storage/uploads/project/'.$image->path }}"
                    default="images/default-image.jpg"/>
            </div>
        @endforeach
    </div>
    <div class="post-text">
        <h3 class="mt-5 fw-bold">{{ $thesisProject->title }}</h3>
        <div class="">
            <ul class="d-flex gap-5">
                <li><a href="">{{ $thesisProject->category?->name }}</a></li>
                <li><a href="">{{ $thesisProject->owner?->name }}</a></li>
            </ul>
        </div>
        <p>{!! $thesisProject->description !!}</p>

        @if (count($thesisProject->pdfs) > 0)
        <div class="">
            @foreach ($thesisProject->pdfs as $pdf)
                <a href="{{ asset('storage/uploads/project/'.$pdf->path) }}" class="btn btn-outline-primary">Downlod PDF</a>
            @endforeach
        </div>
        @endif
        {{-- <div class="d-flex justify-content-between ">
            <h4>V-BE Group</h4>
            <span class="">22.10.2023</span>
        </div>
        <div class="d-flex text-primary justify-content-between ">
            <h5>Group Project</h5>
            <a class="" href="#"><button  class="btn btn-info text-dark"><i class="fa-solid fa-file-lines"></i><span class="text-decoration-none">Download PDF</span></button></a>
        </div> --}}
    </div>
</div>
@endsection
