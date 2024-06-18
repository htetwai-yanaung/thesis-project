@extends('template::layouts.master')
@section('content')
<section class="profile-setting" style="padding-top: 80px">
    <div class="container py-5">
        <form action="{{ route('user.profile.setting.update',Auth::user()->id) }}" method="POST" enctype="multipart/form-data" class="position-relative">
            @csrf
            {{-- toast --}}
            @if (session('status'))
                <div class="toast-container position-absolute top-0 end-0">
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

            <div class="mb-3">
                <div class="gap-3 d-flex justify-content-start align-items-center position-relative" id="file_upload">
                    <div class="profile-img" id="img_preview">
                        @if (empty($user->profile_photo_path))
                            <img src="{{ asset('images/images.png') }}" id="profileImage" alt="profile" width="200" class="img-thumbnail profile-img rounded-circle" />
                        @else
                            <img src="{{ asset('storage/uploads/profile/'.$user->profile_photo_path) }}" id="profileImage" alt="profile" width="200" class="img-thumbnail profile-img rounded-circle" />
                        @endif
                    </div>

                    <div class="" id="hover_effect">
                        <i class="fa-solid fa-camera"></i>
                    </div>
                    <h6 class="text-primary"><label for="profile-image" role="button">Update your profile</label></h6>
                    <input type="file" name="image" id="profile-image" class="d-none">
                    <input type="text" name="role" value="{{ Auth::user()->role }}" class="d-none">
                </div>
            </div>
            <div class="my-4 divider rounded-pill bg-primary" style="height: 3px"></div>
            <h6 class="mb-3 text-info fw-bold">Basic Information</h6>
            <div class="mb-3">
                <label for="profile_name" class="form-label">Username</label>
                <input type="text" name="name" class="form-control" id="profile_name" value="{{ old('name', $user->name) }}" />
            </div>
            <div class="mb-3">
                <label for="profile_gmail" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="profile_gmail" value="{{ old('email', $user->email) }}" />
            </div>
            <div class="mb-3">
                <label for="attended_year" class="form-label">Attended Year</label>
                <select name="year" class="form-select" aria-label="Default select example" id="attended_year">
                    <option value="1" @if($user->year == '1') selected @endif>First</option>
                    <option value="2" @if($user->year == '2') selected @endif>Second</option>
                    <option value="3" @if($user->year == '3') selected @endif>Third</option>
                    <option value="4" @if($user->year == '4') selected @endif>Fourth</option>
                    <option value="5" @if($user->year == '5') selected @endif>Fifth</option>
                    <option value="6" @if($user->year == '6') selected @endif>Final</option>
                </select>
            </div>
            <h6 class="mt-5 mb-3 text-info fw-bold">Change Password</h6>
            <div class="mb-3">
                <label for="old_password" class="form-label">Old Password</label>
                <input type="password" name="password" class="form-control" id="old_password"
                    placeholder="Enter your old password" />
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" name="password_confirmation" class="form-control" id="new_password"
                    placeholder="Enter your new password" />
            </div>
            <div class="text-end">
                <input type="submit" value="Save" class="btn btn-primary" />
            </div>
        </form>
    </div>
</section>
{{-- <script>
    var toastElList = [].slice.call(document.querySelectorAll('.toast'))
    var toastList = toastElList.map(function (toastEl) {
        return new bootstrap.Toast(toastEl, option)
    })
</script> --}}
@endsection

@section('script')
<script>
    $(document).ready(function() {
        const $fileInput = $('#profile-image');

        $fileInput.on('change', function (e) {
            const file = e.target.files;
            handleFile(file);
        });

        function handleFile(file) {
            console.log(file)
            if (file[0].type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    const $img = $('#profileImage');
                    $img.attr('src', event.target.result);
                };
                reader.readAsDataURL(file[0]);
            }
        }
    })
</script>
@endsection
