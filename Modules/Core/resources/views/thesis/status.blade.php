@extends('core::layouts.master')

@section('content')
<div class="">
    <h3 class="fw-bold mb-3">Update Project Status</h3>
    @if (session('error'))
        <p class="p-2 text-center text-white bg-danger">{{ session('error') }}</p>
    @endif
    <form action="{{ route('thesis.updateStatus', $thesisProject->id) }}" method="POST" enctype="multipart/form-data" class="row row-cols-2" id="data-form">
        @csrf
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="1" @selected($thesisProject->status == 1)>Active</option>
                            <option value="2" @selected($thesisProject->status == 2)>Pending</option>
                            <option value="3" @selected($thesisProject->status == 3)>Rejected</option>
                        </select>
                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <a href="{{ route('thesis.index') }}" class="btn btn-outline-danger">Cancel</a>
                        <button class="btn btn-primary float-end">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

