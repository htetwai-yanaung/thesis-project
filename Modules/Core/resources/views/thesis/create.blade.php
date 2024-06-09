@extends('core::layouts.master')

@section('content')
<div class="w-50">
    <form action="{{ route('thesis.store') }}" method="POST" enctype="multipart/form-data" class="d-flex flex-column gap-3" id="data-form">
        @csrf
        <div class="">
            <label for="" class="form-label">Upload your project photo</label>
            <div class="dropzone" id="dropzone1"></div>
            {{-- <small id="image-error" class="text-danger">Please upload project's image(s).</small> --}}
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
        <div class="">
            <button class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
@endsection

@section('script')
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
</script>
@endsection
