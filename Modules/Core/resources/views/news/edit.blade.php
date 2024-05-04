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
                <label for="desc">Description</label>
                <textarea name="description" id="desc" class="form-control" cols="30" rows="10">{{ $news->description }}</textarea>
            </div>
            <input type="file" name="news_image[]" id="newsImage" multiple>

            <button class="btn btn-primary">Save</button>
        </form>
    </div>

@endsection

@section('script')
<script>
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
