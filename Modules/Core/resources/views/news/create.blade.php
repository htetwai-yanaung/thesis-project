@extends('core::layouts.master')

@section('content')
    <div class="w-50">
        @if (session('error'))
            <p class="p-2 text-center text-white bg-danger">{{ session('error') }}</p>
        @endif
        <form action="{{ route('announcement.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name">Title</label>
                <input type="text" name="title" value="{{ old('title') }}" id="name" class="form-control" placeholder="Enter title">
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- <div class="mb-3">
                <label for="desc">Description</label>
                <textarea name="description" id="desc" class="form-control" cols="30" rows="10"></textarea>
            </div> --}}
            <div class="mb-3">
                <label for="">Description</label>
                <textarea name="description" id="editor" class="form-control">{{ old('description') }}</textarea>
                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="">
                <label for="">Upload Images</label>
                <input type="file" name="news_image[]" id="newsImage" multiple
                    data-style-item-panel-aspect-ratio="0.5625" class="form-control">
                    @error('news_image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="">
                <a href="{{ route('announcement.index') }}" class="btn btn-outline-danger">Cancel</a>
                <button class="btn btn-primary float-end">Save</button>
            </div>
        </form>
    </div>
@endsection

@section('script')
<script src="{{ asset('js/ckeditor.js') }}"></script>
<script>
    FilePond.registerPlugin(FilePondPluginImagePreview);
    // Get a reference to the file input element
    const inputElement = document.querySelector('input[id="newsImage"]');

    // Create a FilePond instance
    const pond = FilePond.create(inputElement,{
        server: {
            process: "{{ route('announcement.storeTempFile') }}",
            revert: "{{ route('announcement.deleteTempFile') }}",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        },
    });
</script>
@endsection
