@extends('core::layouts.master')

@section('content')
    <form class="container" action="{{ route('settings.update') }}" method="POST">
        @csrf
        <div class="w-50 d-flex flex-column gap-3">
            {{-- site name --}}
            <div class="">
                <label for="" class="fw-bold">Site Name</label>
                <input type="text" name="site_name" value="{{ $settings->site_name }}" class="form-control" placeholder="Enter site name">
            </div>

            {{-- enable approve --}}
            <div class="">
                <div class="form-check form-switch">
                    <input class="form-check-input" name="enable_approve" type="checkbox" id="enableApprove" @if($settings->enable_approve == 1) checked @endif>
                    <label class="form-check-label" for="enableApprove">Enable Approve</label>
                </div>
            </div>

            {{-- site logo --}}
            <div class="">
                <label for="" class="fw-bold">Logo</label>
                <div class="dropzone w-50" id="dropzone"></div>
            </div>


            <div class="ms-auto">
                <a class="btn btn-outline-primary">Cancel</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>

        </div>
    </form>
@endsection

@section('script')
    <script>
        Dropzone.options.dropzone = {
            url: '{{ route('settings.update') }}',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            autoProcessQueue: true,
            uploadMultiple: false,
            paramName: 'site_image',
            // parallelUploads: 100,
            maxFiles: 1,
            maxFilesize: 12,
            dictDefaultMessage: "Site Image",
            acceptedFiles: '.jpeg, .jpg, .png,',
            addRemoveLinks: true,
            timeout: 5000,
            init: function() {
                var myDropzone = this;
                @if($settings->site_image != null)
                    var siteImage = "{{ $settings->site_image }}";
                    var mockFile = { "name": siteImage };
                    myDropzone.displayExistingFile(mockFile, `{{ asset('storage/uploads/${siteImage}') }}`)
                @endif
            }
        }
    </script>
@endsection
