@extends('core::layouts.master')

@section('content')
    <div class="w-50">
        <form action="{{ route('announcement.update', $news->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" name="title" id="name" value="{{ $news->title }}" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">Description</label>
                <textarea name="description" id="editor" class="form-control">
                    {{ $news->description }}
                </textarea>
            </div>
            <div class="mb-3">
                <label for="">Upload Images</label>
                <input type="file" name="news_image[]" id="newsImage" multiple
                    data-style-item-panel-aspect-ratio="0.5625" class="form-control">
            </div>

            <div class="">
                <a href="{{ route('announcement.index') }}" class="btn btn-outline-danger">Cancel</a>
                <button class="btn btn-primary">Save</button>
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

    @foreach ($images as $image)
        pond.addFile('{{ asset("storage/uploads/news/".$image->path) }}')
    @endforeach

</script>
@endsection
