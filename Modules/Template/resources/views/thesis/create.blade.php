@extends('template::layouts.master')

@section('content')
    <div class="post-detail light-mood" id="detail" style="padding-top: 120px;">
        <form action="{{ route('user.thesis.store') }}" method="POST" enctype="multipart/form-data" class="d-flex flex-column gap-3" id="data-form">
            @csrf
            <div class="">
                <label for="" class="form-label">Project Title</label>
                <input type="text" name="title" class="form-control" placeholder="Enter your project title">
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="">
                <label for="category" class="form-label">Categories</label>
                <select name="category" id="category" class="form-select">
                    <option value="">Choose category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="row">
                <div class="col">
                    <label for="year" class="form-label">Year</label>
                    <select name="year" id="year" class="form-select">
                        <option value="">Choose year</option>
                        <option value="6">Sixth Year</option>
                        <option value="5">Fifth Year</option>
                        <option value="4">Fourth Year</option>
                        <option value="3">Third Year</option>
                        <option value="2">Second Year</option>
                        <option value="1">First Year</option>
                    </select>
                    @error('year')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col">
                    <label for="project_type" class="form-label">Project Type</label>
                    <select name="project_type" id="project_type" class="form-select">
                        <option value="">Project Type</option>
                        <option value="1">Thesis Project</option>
                        <option value="2">Group Project</option>
                    </select>
                    @error('project_type')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="">
                <label for="editor" class="form-label">Description</label>
                <textarea name="description" id="editor" class="form-control">

                </textarea>
                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="">
                <label for="" class="form-label">Upload Images</label>
                <input type="file" name="thesis_image[]" id="thesisImage" multiple
                    data-style-item-panel-aspect-ratio="0.5625" class="form-control">
            </div>

            <div class="">
                <a href="{{ route('thesis.index') }}" class="btn btn-outline-danger">Cancel</a>
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
    const inputElement = document.querySelector('input[id="thesisImage"]');

    // Create a FilePond instance
    const pond = FilePond.create(inputElement,{
        server: {
            process: "{{ route('thesis.storeTempFile') }}",
            revert: "{{ route('thesis.deleteTempFile') }}",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        },
    });
</script>
@endsection
