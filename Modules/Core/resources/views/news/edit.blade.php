@extends('core::layouts.master')

@section('content')
    <div class="">
        <h3 class="fw-bold mb-3">Edit News</h3>
        @if (session('error'))
            <p class="p-2 text-center text-white bg-danger">{{ session('error') }}</p>
        @endif
        <form action="{{ route('announcement.update', $news->id) }}" method="POST" class="row row-cols-2">
            @csrf
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Title</label>
                            <input type="text" name="title" value="{{ old('title',$news->title) }}" id="name" class="form-control" placeholder="Enter title">
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" id="editor" class="form-control">{{ old('description',$news->description) }}</textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Upload Images</label>
                            <div class="dropzone" id="dropzone1"></div>
                            @error('news_image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="isPublic" name="status" @checked(old('status',$news->status))>
                                <label class="form-check-label" for="isPublic">Publish</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <a href="{{ route('announcement.index') }}" class="btn btn-outline-danger">Cancel</a>
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
        acceptedFiles: 'image/*',
        dictDefaultMessage: "Drop images here or click to upload",
        // previewTemplate: previewTemplate,
        init: function() {
            this.on("addedfile", file => {
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'news_image[]';
                input.value = file.name;
                file.previewElement.appendChild(input);
                if(file.type == 'application/pdf'){
                    file.previewElement.querySelector('img').src = '{{ asset("images/pdf.png") }}';
                }

            });
            this.on("successmultiple", (file, response) => {
                console.log(response);
            });

            @if(isset($news) && $news->images->count() > 0)
                @foreach($news->images as $image)
                    var mockFile = { name: "{{ $image->path }}", size: "{{ $image->file_size }}", accepted: true };
                    // console.log(mockFile);
                    // this.emit("addedfile", mockFile);
                    this.displayExistingFile(mockFile, "{{ asset('storage/uploads/news/') }}"+"/{{ $image->path }}")
                    // this.emit("complete", mockFile);
                @endforeach
            @endif
        },
        success: function(file, response){
            var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'news_image[]';
                input.value = response;
                file.previewElement.appendChild(input);
        },
        error: function(file, response){
            console.log(response);
        }
    }



</script>
@endsection
