@extends('core::layouts.master')

@section('content')
<div class="">
    <h3 class="fw-bold mb-3">Create Category</h3>
    @if (session('error'))
        <p class="p-2 text-center text-white bg-danger">{{ session('error') }}</p>
    @endif

    <form action="{{ route('category.store') }}" method="POST" class="row row-cols-2">
        @csrf
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="" class="form-label">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Enter name">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="desc" class="form-label">Description</label>
                        <textarea name="description" id="desc" cols="30" rows="3" class="form-control" placeholder="Enter description">{{ old('description') }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="isPublic" name="status" @checked(old('status'))>
                            <label class="form-check-label" for="isPublic">Publish</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <a href="{{ route('category.index') }}" class="btn btn-outline-danger">Cancel</a>
                        <button class="btn btn-primary float-end">Save</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>

@endsection
