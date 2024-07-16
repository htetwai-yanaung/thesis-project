@extends('core::layouts.master')

@section('content')
    <div class="w-50">
        {{-- error toast --}}
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" autohide="true" delay="3000">
                <div class="toast-header">
                {{-- <img src="..." class="rounded me-2" alt="..."> --}}
                <strong class="me-auto">Project Update Error</strong>
                <small>11 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" id="error-message"></div>
            </div>
        </div>

        <h1>Edit Your Thesis</h1>
        <form action="{{ route('thesis.update', $thesisProject->id) }}" method="POST" enctype="multipart/form-data" class="d-flex flex-column gap-3" id="data-form">
            @csrf
            <div class="">
                <label for="" class="form-label">Project Title</label>
                <input type="text" name="title" value="{{ old('title', $thesisProject->title) }}" class="form-control" placeholder="Enter your project title">
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="">
                <label for="category" class="form-label">Categories</label>
                <select name="category" id="category" class="form-select">
                    <option value="">Choose category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if($category->id == $thesisProject->category_id) selected @endif>{{ $category->name }}</option>
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
                        <option value="6" @if($thesisProject->year_id == "6") selected @endif>Sixth Year</option>
                        <option value="5" @if($thesisProject->year_id == "5") selected @endif>Fifth Year</option>
                        <option value="4" @if($thesisProject->year_id == "4") selected @endif>Fourth Year</option>
                        <option value="3" @if($thesisProject->year_id == "3") selected @endif>Third Year</option>
                        <option value="2" @if($thesisProject->year_id == "2") selected @endif>Second Year</option>
                        <option value="1" @if($thesisProject->year_id == "1") selected @endif>First Year</option>
                    </select>
                    @error('year')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col">
                    <label for="project_type" class="form-label">Project Type</label>
                    <select name="project_type" id="project_type" class="form-select">
                        <option value="">Project Type</option>
                        <option value="1" @if($thesisProject->project_type == "1") selected @endif>Thesis Project</option>
                        <option value="2" @if($thesisProject->project_type == "2") selected @endif>Group Project</option>
                    </select>
                    @error('project_type')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="">
                <label for="editor" class="form-label">Description</label>
                <textarea name="description" id="editor" class="form-control">
                    {{ old('description', $thesisProject->description) }}
                </textarea>
                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="">
                <label for="" class="form-label">Upload Images</label>
                <div class="dropzone" id="dropzone1"></div>
                {{-- <input type="file" name="thesis_image[]" id="thesisImage" multiple
                    data-style-item-panel-aspect-ratio="0.5625" class="form-control"> --}}
            </div>
            <div class="">
                <a href="{{ route('thesis.index') }}" class="btn btn-outline-danger">Cancel</a>
                <button type="submit" id="submit-all" class="btn btn-primary float-end">Save</button>
            </div>
        </form>
    </div>
@endsection

@section('script')
<script src="{{ asset('js/ckeditor.js') }}"></script>
{{-- <script>
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

    @foreach ($thesisProject->images as $image)
        pond.addFile('{{ asset("storage/uploads/project/".$image->path) }}')
    @endforeach
</script> --}}
<script>

    Dropzone.options.dropzone1 = {
        url: "{{ route('dropzone.tempStore') }}",
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        method: "post",
        paramName: "file",
        maxFilesize: 3, //MB
        uploadMultiple: false,
        addRemoveLinks: true,
        parallelUploads: 100,
        acceptedFiles: 'image/*, application/pdf',
        dictDefaultMessage: "Drop images here or click to upload",
        // previewTemplate: previewTemplate,
        init: function() {
            this.on("addedfile", file => {
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'thesis_image[]';
                input.value = file.name;
                file.previewElement.appendChild(input);
                if(file.type == 'application/pdf'){
                    file.previewElement.querySelector('img').src = '{{ asset("images/pdf.png") }}';
                }

            });
            this.on("successmultiple", (file, response) => {
                console.log(response);
            });

            @if(isset($thesisProject) && $thesisProject->images->count() > 0)
                @foreach($thesisProject->images as $image)
                    var mockFile = { name: "{{ $image->path }}", size: "{{ $image->file_size }}", accepted: true };
                    // console.log(mockFile);
                    // this.emit("addedfile", mockFile);
                    this.displayExistingFile(mockFile, "{{ asset('storage/uploads/project/') }}"+"/{{ $image->path }}")
                    // this.emit("complete", mockFile);
                @endforeach
            @endif
            @if(isset($thesisProject) && $thesisProject->pdfs->count() > 0)
                @foreach($thesisProject->pdfs as $pdf)
                    var mockFile = { name: "{{ $pdf->path }}", size: "{{ $pdf->file_size }}", accepted: true };
                    // console.log(mockFile);
                    // this.emit("addedfile", mockFile);
                    this.displayExistingFile(mockFile, "{{ asset('images/pdf.png') }}")
                    // this.emit("complete", mockFile);
                @endforeach
            @endif
        },
        success: function(file, response){
            var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'thesis_image[]';
                input.value = response;
                file.previewElement.appendChild(input);
        },
        error: function(file, response){
            console.log(response);
        }
    }



</script>
@endsection
