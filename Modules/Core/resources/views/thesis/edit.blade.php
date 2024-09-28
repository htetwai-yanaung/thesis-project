@extends('core::layouts.master')

@section('content')
<div class="">
    <h3 class="fw-bold mb-3">Create Project</h3>
    @if (session('error'))
        <p class="p-2 text-center text-white bg-danger">{{ session('error') }}</p>
    @endif
    <form action="{{ route('thesis.update', $thesisProject->id) }}" method="POST" enctype="multipart/form-data" class="row row-cols-2" id="data-form">
        @csrf
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Project Title</label>
                        <input type="text" name="title" value="{{ old('title', $thesisProject->title) }}" class="form-control" placeholder="Enter your project title">
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="category">Categories</label>
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
                    <div class="form-group row">
                        <div class="col">
                            <label for="year">Year</label>
                            <select name="year" id="year" class="form-select">
                                <option value="">Choose year</option>
                                @foreach ($years as $year)
                                <option value="{{ $year->id }}" @if($year->id == $thesisProject->year_id) selected @endif>{{ $year->year }}</option>
                                @endforeach
                            </select>
                            @error('year')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="project_type">Project Type</label>
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
                    <div class="form-group">
                        <label for="editor">Description</label>
                        <textarea name="description" id="editor" class="form-control">
                            {{ old('description', $thesisProject->description) }}
                        </textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Upload Images</label>
                        <div class="dropzone" id="dropzone1"></div>
                    </div>

                    <div class="form-group">
                        <a href="{{ route('thesis.index') }}" class="btn btn-outline-danger">Cancel</a>
                        <button class="btn btn-primary float-end">Save</button>
                    </div>
                </div>
            </div>
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
            @if(isset($thesisProject) && $thesisProject->projectFiles->count() > 0)
                @foreach($thesisProject->projectFiles as $pdf)
                    var mockFile = { name: "{{ $pdf->path }}", size: "{{ $pdf->file_size }}", accepted: true };
                    // console.log(mockFile);
                    // this.emit("addedfile", mockFile);
                    this.displayExistingFile(mockFile, "{{ asset('images/'.$pdf->file_type.'.png') }}")
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
