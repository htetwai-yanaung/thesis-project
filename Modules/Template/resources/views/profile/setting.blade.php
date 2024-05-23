@extends('template::layouts.master')
@section('content')
<section class="profile-setting" style="padding-top: 80px">
    <div class="container py-5">
        <form action="">
            <div class="mb-3">
                <input type="file" accept="image/*" class="d-none" id="upload_profile" />
            </div>
            <div class="mb-3">
                <div class="gap-3 d-flex justify-content-start align-items-center position-relative"
                    id="file_upload">
                    <div class="" id="img_preview">
                        <img src="./Images/Ellipse 4.png" alt="" class="rounded-circle" />
                    </div>

                    <div class="" id="hover_effect">
                        <i class="fa-solid fa-camera"></i>
                    </div>
                    <h6 class="text-primary">Update your profile</h6>
                </div>
            </div>
            <div class="my-4 divider rounded-pill bg-primary" style="height: 3px"></div>
            <h6 class="mb-3 text-info fw-bold">Basic Information</h6>
            <div class="mb-3">
                <label for="profile_name" class="form-label">Username</label>
                <input type="text" class="form-control" id="profile_name" value="Ko Tect Htun" />
            </div>
            <div class="mb-3">
                <label for="profile_gmail" class="form-label">Email address</label>
                <input type="email" class="form-control" id="profile_gmail" value="texthtun12@gmail.com" />
            </div>
            <div class="mb-3">
                <label for="attended_year" class="form-label">Attended Year</label>
                <select class="form-select" aria-label="Default select example" id="attended_year">
                    <option selected value="0">First</option>
                    <option value="1">Second</option>
                    <option value="2">Third</option>
                    <option value="3">Fourth</option>
                    <option value="5">Fifth</option>
                    <option value="6">Final</option>
                </select>
            </div>
            <h6 class="mt-5 mb-3 text-info fw-bold">Change Password</h6>
            <div class="mb-3">
                <label for="old_password" class="form-label">Old Password</label>
                <input type="password" class="form-control" id="old_password"
                    placeholder="Enter your old password" />
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="new_password"
                    placeholder="Enter your new password" />
            </div>
            <div class="text-end">
                <input type="submit" value="Save" class="btn btn-primary" />
            </div>
        </form>
    </div>
</section>
@endsection