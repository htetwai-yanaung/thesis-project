@extends('template::layouts.master')
@section('content')
<div class="post-detail light-mood" id="detail" style="padding-top: 50px;">
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this project? It can't be undo.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="{{ route('user.thesis.delete', $thesisProject->id) }}" class="btn btn-danger" id="modalDeleteBtn">Delete</a>
                </div>
            </div>
        </div>
    </div>

    @if ($thesisProject->owner?->id == Auth::id())
    <div class="row d-flex justify-content-end">
        <div class="w-auto">
            <a href="{{ route('user.thesis.edit', $thesisProject->id) }}" class="btn btn-primary"><i class="fa fa-pen"></i></a>
            <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-trash"></i></button>
        </div>
    </div>
    @endif
    <div class="row">
        @foreach ($thesisProject->images as $image)
            <div class="column">
                <x-image class="img-fluid"
                    src="{{ 'storage/uploads/project/'.$image->path }}"
                    default="images/default-image.jpg"/>
            </div>
        @endforeach
    </div>
    <div class="post-text text-secondary">
        <h3 class="mt-5 fw-bold">{{ $thesisProject->title }}</h3>
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item active text-secondary">{{ $thesisProject->category?->name }}</li>
                  <li class="breadcrumb-item active text-secondary">{{ $thesisProject->owner?->name }}</li>
                  <li class="breadcrumb-item active text-secondary">{{ $thesisProject->created_at->format('d/m/Y') }}</li>
                </ol>
            </nav>
        </div>
        <p>{!! $thesisProject->description !!}</p>

        @if (count($thesisProject->projectFiles) > 0)
        <div class="">
            @foreach ($thesisProject->projectFiles as $pdf)
                <a href="{{ asset('storage/uploads/project/'.$pdf->path) }}" class="btn btn-outline-primary">Downlod {{ $pdf->file_type }}</a>
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

{{-- @section('script')
<script>
    $('document').ready(function() {
        $projectId = "<?php echo request()->get('id') ?>";
        console.log($projectId);
        $.ajax({
            type: 'get',
            url: "{{ route('thesis#addPopular') }}",
            data: {
                id: $projectId
            },
            dataType: 'json',
            success: function(res){
                console.log(res);
            }
        })
    })
</script>
@endsection --}}
