@extends('core::layouts.master')

@section('content')
    <div class="">
        <h1>Profile</h1>
        @if (session('error'))
            <p class="p-2 text-center text-white bg-danger">{{ session('error') }}</p>
        @endif
        @if (session('success'))
            <p class="p-2 text-center text-white bg-success">{{ session('success') }}</p>
        @endif
        <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="gap-3 w-50 d-flex flex-column">
            @csrf
            <div class="">
                <img src="{{ asset('storage/uploads/profile/'.$user->profile_photo_path) }}" alt="">
                <label for="image"><i class="fas fa-fw fa-pencil"></i></label>
                <input type="file" name="image" id="image" class="d-none">
            </div>
            <div>
                <label class="form-label">Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" placeholder="Enter name">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div>
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" placeholder="Enter email">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            @if ($user->role == 3)
            <div>
                <label class="form-label">Year</label>
                <select name="year" class="form-control">
                    <option value="1" @if($user->year == 1) selected @endif>1st Year</option>
                    <option value="2" @if($user->year == 2) selected @endif>2nd Year</option>
                    <option value="3" @if($user->year == 3) selected @endif>3rd Year</option>
                    <option value="4" @if($user->year == 4) selected @endif>4th Year</option>
                    <option value="5" @if($user->year == 5) selected @endif>5th Year</option>
                    <option value="6" @if($user->year == 6) selected @endif>6th Year</option>
                </select>
                @error('year')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            @endif
            <div>
                <label class="form-label">Role</label>
                <select name="role" class="form-control" >
                    <option value="1" @if($user->role == 1) selected @endif>Admin</option>
                    <option value="2" @if($user->role == 2) selected @endif>Teacher</option>
                    <option value="3" @if($user->role == 3) selected @endif>Student</option>
                </select>
                @error('role')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div>
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter password">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div>
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Enter confirm password">
                @error('password_confirmation')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="ms-auto">
                <a class="btn btn-outline-primary">Cancel</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
@endsection
