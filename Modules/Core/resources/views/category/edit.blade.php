@extends('core::layouts.master')

@section('content')
<div class="w-50">
    @if (session('error'))
        <p class="p-2 text-center text-white bg-danger">{{ session('error') }}</p>
    @endif
    <form action="{{ route('category.update', $category->id) }}" method="POST" class="d-flex flex-column gap-3">
        @csrf
        <div class="">
            <label for="" class="form-label">Name</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" class="form-control" placeholder="Enter name">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="">
            <label for="desc" class="form-label">Description</label>
            <textarea name="description" id="desc" cols="30" rows="3" class="form-control" placeholder="Enter description">{{ old('description', $category->description) }}</textarea>
            @error('description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="isPublic" name="status" @checked(old('status', $category->status))>
                <label class="form-check-label" for="isPublic">Publish</label>
            </div>
        </div>
        <div class="">
            <a href="{{ route('category.index') }}" class="btn btn-outline-danger">Cancel</a>
            <button class="btn btn-primary float-end">Save</button>
        </div>
    </form>
</div>

@endsection
