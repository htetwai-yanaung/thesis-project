@extends('core::layouts.master')

@section('content')
    <div class="w-50">
        {{-- error toast --}}
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" autohide="true" delay="3000">
                <div class="toast-header">
                {{-- <img src="..." class="rounded me-2" alt="..."> --}}
                <strong class="me-auto">Project Create Error</strong>
                <small>11 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" id="error-message"></div>
            </div>
        </div>

        <h1>Create Your Thesis</h1>
        <form action="{{ route('thesis.store') }}" method="POST" enctype="multipart/form-data" class="d-flex flex-column gap-3" id="data-form">
            @csrf
            <div class="">
                <label for="" class="form-label">Upload your project photo</label>
                <div class="dropzone" id="dropzone1"></div>
                <small id="image-error" class="text-danger">Please upload project's image(s).</small>
                @error('file')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="">
                <label for="" class="form-label">Project Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title',$thesisProject->title) }}" placeholder="Enter your project title">
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="">
                <label for="" class="form-label">Project Description</label>
                <textarea name="description" class="form-control" rows="3" placeholder="Enter your project description">{{ old('description', $thesisProject->description) }}</textarea>
                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- <div class="">
                <label for="" class="form-label">Upload your project PDF file (Optional)</label>
                <div class="dropzone" id="dropzone1"></div>

                @error('pdf')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div> --}}
            <div class="">
                <label for="" class="form-label">Attended Year</label>
                <select name="year" class="form-select">
                    <option value="">Choose attended year</option>
                    <option value="1" @if($thesisProject->year == 1) selected @endif>1st Year</option>
                    <option value="2" @if($thesisProject->year == 2) selected @endif>2nd Year</option>
                    <option value="3" @if($thesisProject->year == 3) selected @endif>3rd Year</option>
                    <option value="4" @if($thesisProject->year == 4) selected @endif>4th Year</option>
                    <option value="5" @if($thesisProject->year == 5) selected @endif>5th Year</option>
                    <option value="6" @if($thesisProject->year == 6) selected @endif>6th Year</option>
                </select>
                @error('year')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="">
                <label for="" class="form-label">Project Type</label>
                <select name="project_type" class="form-select">
                    <option value="">Choose project type</option>
                    <option value="1" @if($thesisProject->project_type == 1) selected @endif>Single Project</option>
                    <option value="2" @if($thesisProject->project_type == 2) selected @endif>Group Project</option>
                </select>
                @error('project_type')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="">
                <button type="submit" id="submit-all" class="btn btn-primary float-end">Post Now</button>
            </div>
        </form>
    </div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('#image-error').hide();

        function showError(err){
            console.log(err);
        }
    })
</script>
<script>
    // Dropzone.options.dropzone1 = {
    //     url: '{{ route('thesis.store') }}',
    //     headers: {
    //         'X-CSRF-TOKEN': "{{ csrf_token() }}"
    //     },
    //     autoProcessQueue: false,
    //     uploadMultiple: true,
    //     parallelUploads: 100,
    //     maxFiles: 100,
    //     maxFilesize: 12,
    //     renameFile: function(file){
    //         var dt = new Date();
    //         var time = dt.getTime();
    //         return '{{ Auth::user()->id }}'+'_thumbnail';
    //     },
    //     acceptedFiles: '.jpeg, .jpg, .png, .pdf',
    //     addRemoveLinks: true,
    //     timeout: 5000,
    //     init: function() {
    //         var myDropzone = this;
    //         var project = <?php echo $thesisProject; ?>;
    //         // console.log(project)
    //         // for (const image of project.images) {
    //         //     let mockFile = { name: "Filename", size: 12345 };
    //         //     myDropzone.displayExistingFile(mockFile, `{{ asset('storage/uploads/project/${image.path}') }}`);
    //         // }

    //         @if(isset($thesisProject) && $thesisProject->images->count() > 0)
    //             @foreach($thesisProject->images as $image)
    //                 var mockFile = { name: "{{ $image->path }}", size: {{ $image->file_size }}, accepted: true };
    //                 myDropzone.emit("addedfile", mockFile);
    //                 myDropzone.emit("thumbnail", mockFile, "{{ asset('storage/uploads/project/') }}"+"{{ $image->path }}");
    //                 myDropzone.emit("complete", mockFile);
    //             @endforeach
    //         @endif

    //         // append form data
    //         this.on("sendingmultiple", (file, xhr, formData) => {
    //             $("form").find("input").each(function(){
    //                 formData.append($(this).attr("name"), $(this).val());
    //             });
    //             $("form").find("textarea").each(function(){
    //                 formData.append($(this).attr("name"), $(this).val());
    //             });
    //             $("form").find("select").each(function(){
    //                 formData.append($(this).attr("name"), $(this).val());
    //             });
    //         });



    //         // when submit
    //         $("#submit-all").click(function (e) {
    //             e.preventDefault();
    //             e.stopPropagation();
    //             if(myDropzone.getQueuedFiles().length == 0){
    //                 $('#image-error').show();
    //             }else{
    //                 $('#image-error').hide();
    //             }
    //             console.log(myDropzone.files);
    //             myDropzone.processQueue();
    //         })
    //     },
    //     success: function(file, response){
    //         window.location.href = "{{ route('thesis.index') }}";
    //     },
    //     errormultiple: function(file, response){
    //         var myDropzone = this;
    //         myDropzone.removeAllFiles();
    //         file.forEach((e)=>{
    //             myDropzone.addFile(e);
    //         });
    //         $('#error-message').html("<p>"+response.message+"</p>")
    //         $('#liveToast').addClass('show');
    //         return false;
    //     }
    // }

    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("#dropzone1",{
        url: '{{ route('thesis.store') }}',
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        autoProcessQueue: false,
        uploadMultiple: true,
        // previewTemplate: previewTemplate,
        parallelUploads: 100,
        maxFiles: 100,
        maxFilesize: 12,
        acceptedFiles: '.jpeg, .jpg, .png, .pdf',
        addRemoveLinks: true,
        dictDefaultMessage: "Drop images here or click to upload",
        timeout: 5000,
    })
    @if(isset($thesisProject) && $thesisProject->images->count() > 0)
        @foreach($thesisProject->images as $image)
            var mockFile = { name: "{{ $image->path }}", size: "{{ $image->file_size }}", accepted: true };
            myDropzone.emit("addedfile", mockFile);
            @if($image->type == 'pdf'){
                myDropzone.emit("thumbnail", mockFile, "{{ asset('storage/uploads/pdf-logo.jpg') }}");
            }@else{
                myDropzone.emit("thumbnail", mockFile, "{{ asset('storage/uploads/project/') }}"+"/{{ $image->path }}");
            }
            @endif
            myDropzone.emit("complete", mockFile);
        @endforeach
    @endif

</script>
@endsection
