@extends('core::layouts.master')

@section('content')
    <div class="w-50">
        <h1>Create Your Thesis</h1>
        @if (session('error'))
            <p class="bg-danger text-white p-2 text-center">{{ session('error') }}</p>
        @endif
        @if (session('success'))
            <p class="bg-success text-white p-2 text-center">{{ session('success') }}</p>
        @endif
        <form action="{{ route('thesis.store') }}" method="POST" enctype="multipart/form-data" class="d-flex flex-column gap-3">
            @csrf
            <div class="">
                <label for="" class="form-label">Upload your project photo</label>
                <div class="dropzone" id="dropzone">
                </div>

                @error('images')
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
                <label for="" class="form-label">Upload your project PDF file (Optional)</label>
                <input type="file" name="pdf" class="form-control">
                @error('pdf')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
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
                <button type="submit" id="submit-all" class="btn btn-primary float-end">Post Now</button>
            </div>
        </form>
    </div>
@endsection

@section('script')
{{-- <script>
  var uploadedDocumentMap = {}
  Dropzone.options.documentDropzone = {
    url: '{{ route('thesis.store') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
      uploadedDocumentMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedDocumentMap[file.name]
      }
      $('form').find('input[name="document[]"][value="' + name + '"]').remove()
    },
    init: function () {
      @if(isset($project) && $project->document)
        var files =
          {!! json_encode($project->document) !!}
        for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
        }
      @endif
    }
  }
</script> --}}
<script>
    Dropzone.options.dropzone = {
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
        acceptedFiles: '.jpeg, .jpg, .png',
        addRemoveLinks: true,
        timeout: 5000,
        init: function() {
            // this.on("addedfile", file => {
            //     console.log(file)
            //     $('form').append('<input type="hidden" name="images[]" value="' + file.name + '">')
            // });
            // this.on("removedfile", file => {
            //     console.log(file);
            // })
            this.on("sending", (file, xhr, formData) => {
                formData.append('title','title');
                formData.append('description','description');
                formData.append('year','2');
                formData.append('project_type','1');
                // formData.append('images',file.name);
            })
            var myDropzone = this;
            $("#submit-all").click(function (e) {
                e.preventDefault();
                e.stopPropagation();
                myDropzone.processQueue();
            })
        },
        success: function(file, response){
            console.log(response);
        },
        error: function(file, response){
            console.log(response);
            return false;
        }
    }
</script>
@endsection
