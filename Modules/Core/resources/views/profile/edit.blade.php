@extends('core::layouts.master')

@section('content')
    <div class="">
        <h3 class="fw-bold mb-3">Profile</h3>
        @if (session('error'))
            <p class="p-2 text-center text-white bg-danger">{{ session('error') }}</p>
        @endif
        @if (session('success'))
            <p class="p-2 text-center text-white bg-success">{{ session('success') }}</p>
        @endif
        <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="row row-cols-2">
            @csrf
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="image-input" class="avatar avatar-xxl img-thumbnail" style="cursor: pointer;">
                                <x-image src="{{ 'storage/uploads/profile/'.$user->profile_photo_path }}" class="avatar-img" id="profile-img" alt="profile-image"/>
                            </label>
                            <input type="file" name="image" id="image-input" class="d-none">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" placeholder="Enter name">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" placeholder="Enter email">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        @if ($user->role == 3)
                        <div class="form-group">
                            <label class="form-label">Year</label>
                            <select name="year" class="form-select">
                                @foreach ($years as $year)
                                    <option value="{{ $year->id }}" @selected($user->year == $year->id)>{{ $year->year }}</option>
                                @endforeach
                            </select>
                            @error('year')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        @endif
                        <div class="form-group">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-select" @disabled($user->id == Auth::id())>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" @selected($user->role == $role->id)>{{ $role->role }}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter password">
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Enter confirm password">
                            @error('password_confirmation')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            {{-- <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-danger">Cancel</a> --}}
                            <button type="submit" class="btn btn-primary float-end">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        const $fileInput = $('#image-input');

        $fileInput.on('change', function (e) {
            const file = e.target.files;
            handleFile(file);
        });

        function handleFile(file) {
            console.log(file)
            if (file[0].type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    const $img = $('#profile-img');
                    $img.attr('src', event.target.result);
                };
                reader.readAsDataURL(file[0]);
            }
        }
    })
</script>
@endsection
