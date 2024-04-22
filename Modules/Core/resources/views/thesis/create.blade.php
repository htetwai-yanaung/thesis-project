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
        <form action="{{ route('thesis.store') }}" method="POST" enctype="multipart/form-data" class="d-flex flex-column gap-3 dropzone" id="my-great-dropzone">
            @csrf
            <div class="">
                <label for="" class="form-label">Upload your project photo</label>
                <input type="file" name="photo" class="form-control">
                @error('photo')
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
                <button class="btn btn-primary float-end">Post Now</button>
            </div>
        </form>
    </div>
@endsection

@section('script')
<script>
    Dropzone.options.myGreatDropzone = { // camelized version of the `id`
      paramName: "file", // The name that will be used to transfer the file
      maxFilesize: 2, // MB
      accept: function(file, done) {
        if (file.name == "justinbieber.jpg") {
          done("Naha, you don't.");
        }
        else { done(); }
      }
    };
  </script>
@endsection
