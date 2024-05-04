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
                <input type="text" name="title" class="form-control" placeholder="Enter your project title">
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="">
                <label for="" class="form-label">Project Description</label>
                <textarea name="description" class="form-control" rows="3" placeholder="Enter your project description"></textarea>
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
            {{-- <div id="drop-area">
                <div class="preview-1">
                    <h3>Drag & Drop files here</h3>
                    <p>or</p>
                    <input type="file" name="new[]" id="file-input" multiple>
                    <label for="file-input">Select Files</label>
                </div>

                <p id="file-list"></p>
            </div> --}}
            <div class="">
                <label for="" class="form-label">Attended Year</label>
                <select name="year" class="form-select">
                    <option value="">Choose attended year</option>
                    <option value="1">1st Year</option>
                    <option value="2">2nd Year</option>
                    <option value="3">3rd Year</option>
                    <option value="4">4th Year</option>
                    <option value="5">5th Year</option>
                    <option value="6">6th Year</option>
                </select>
                @error('year')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="">
                <label for="" class="form-label">Project Type</label>
                <select name="project_type" class="form-select">
                    <option value="">Choose project type</option>
                    <option value="1">Single Project</option>
                    <option value="2">Group Project</option>
                </select>
                @error('project_type')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="">
                <a href="{{ route('thesis.index') }}" class="btn btn-outline-primary">Back</a>
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
    Dropzone.options.dropzone1 = {
        url: '{{ route('thesis.store') }}',
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 100,
        maxFiles: 100,
        maxFilesize: 12,
        renameFile: function(file){
            var dt = new Date();
            var time = dt.getTime();
            return '{{ Auth::user()->id }}'+'_thumbnail';
        },
        acceptedFiles: '.jpeg, .jpg, .png, .pdf',
        addRemoveLinks: true,
        timeout: 5000,
        init: function() {
            // append form data
            this.on("sendingmultiple", (file, xhr, formData) => {
                $("form").find("input").each(function(){
                    formData.append($(this).attr("name"), $(this).val());
                });
                $("form").find("textarea").each(function(){
                    formData.append($(this).attr("name"), $(this).val());
                });
                $("form").find("select").each(function(){
                    formData.append($(this).attr("name"), $(this).val());
                });
            });

            var myDropzone = this;

            // when submit
            $("#submit-all").click(function (e) {
                e.preventDefault();
                e.stopPropagation();
                if(myDropzone.getQueuedFiles().length == 0){
                    $('#image-error').show();
                }else{
                    $('#image-error').hide();
                }
                console.log(myDropzone.files);
                myDropzone.processQueue();
            })
        },
        success: function(file, response){
            window.location.href = "{{ route('thesis.index') }}";
        },
        errormultiple: function(file, response){
            var myDropzone = this;
            myDropzone.removeAllFiles();
            file.forEach((e)=>{
                myDropzone.addFile(e);
            });
            $('#error-message').html("<p>"+response.message+"</p>")
            $('#liveToast').addClass('show');
            return false;
        }
    }

    // Dropzone.options.dropzone2 = {
    //     url: '{{ route('thesis.store') }}',
    //     headers: {
    //         'X-CSRF-TOKEN': "{{ csrf_token() }}"
    //     },
    //     autoProcessQueue: false,
    //     uploadMultiple: true,
    //     parallelUploads: 100,
    //     maxFiles: 100,
    //     maxFilesize: 12,
    //     acceptedFiles: '.pdf',
    //     addRemoveLinks: true,
    //     timeout: 5000,
    //     init: function() {

    //     },
    // }
</script>
@endsection
