@extends('core::layouts.master')

@section('content')
    <div class="">
        <h3 class="fw-bold mb-3">Edit Year</h3>
        @if (session('error'))
            <p class="p-2 text-center text-white bg-danger">{{ session('error') }}</p>
        @endif
        <form action="{{ route('year.update', $year->id) }}" method="POST" class="row row-cols-2">
            @csrf
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Year</label>
                            <input type="text" name="year" value="{{ old('year',$year->year) }}" id="name" class="form-control" placeholder="Enter year">
                            @error('year')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="isPublic" name="status" @checked(old('status',$year->status))>
                                <label class="form-check-label" for="isPublic">Publish</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <a href="{{ route('year.index') }}" class="btn btn-outline-danger">Cancel</a>
                            <button class="btn btn-primary float-end">Save</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection
