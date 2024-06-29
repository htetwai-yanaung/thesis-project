@extends('template::layouts.master')

@section('content')
    <div class="post-detail light-mood position-relative" id="detail" style="padding-top: 120px;">
        @if (session('status'))
            <div class="toast-container position-absolute top-25 end-0">
                <div class="toast align-items-center show @if(session('status') == 'success') bg-success @else bg-danger @endif"
                role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="3000">
                    <div class="d-flex">
                        <div class="toast-body text-white">
                            {{ session('message') }}
                        </div>
                        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('user.thesis.store') }}" method="POST" enctype="multipart/form-data" class="d-flex flex-column gap-3" id="data-form">
            @csrf
            <div class="">
                <label for="" class="form-label">Project Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="Enter your project title">
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="">
                <label for="category" class="form-label">Categories</label>
                <select name="category" id="category" class="form-select">
                    <option value="">Choose category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category') == $category->id)>{{ $category->name }}</option>
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
                        <option value="6" @selected(old('year') == '1')>Sixth Year</option>
                        <option value="5" @selected(old('year') == '2')>Fifth Year</option>
                        <option value="4" @selected(old('year') == '3')>Fourth Year</option>
                        <option value="3" @selected(old('year') == '4')>Third Year</option>
                        <option value="2" @selected(old('year') == '5')>Second Year</option>
                        <option value="1" @selected(old('year') == '6')>First Year</option>
                    </select>
                    @error('year')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col">
                    <label for="project_type" class="form-label">Project Type</label>
                    <select name="project_type" id="project_type" class="form-select">
                        <option value="">Project Type</option>
                        <option value="1" @selected(old('project_type') == '1')>Thesis Project</option>
                        <option value="2" @selected(old('project_type') == '2')>Group Project</option>
                    </select>
                    @error('project_type')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="">
                <label for="editor" class="form-label">Description</label>
                <textarea name="description" id="editor" class="form-control">
                    {{ old('description') }}
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
                <button type="submit" class="btn btn-primary float-end" id="submitBtn">Save</button>
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
        // files: [
        //     {
        //         // the server file reference
        //         source: "{{ asset('storage/uploads/thesis/6665c702e0df3_.png') }}",

        //         // set type to limbo to tell FilePond this is a temp file
        //         options: {
        //             // type: 'limbo',
        //             type: 'local',
        //         },
        //     },
        // ],
    });

</script>
@endsection
