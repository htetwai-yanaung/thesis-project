@extends('core::layouts.master')

@section('content')
    <div class="">
        <h3 class="fw-bold mb-3">Thesis Projects List</h3>
        <div class="row justify-content-end mb-3">
            <div class="col-3">
                <a href="{{ route('thesis.create') }}" class="btn btn-primary float-end">
                    <span class="btn-label">
                      <i class="fas fa-plus"></i>
                    </span>
                    Create New Project
                </a>
                {{-- <a href="{{ route('thesis.create') }}" class="btn btn-primary float-end">Create New Project</a> --}}
            </div>
        </div>
        <form action="{{ route('thesis.index') }}" method="GET" class="row mb-3">
            {{-- @csrf --}}
            <div class="d-flex">
                <div class="ms-auto d-flex gap-2">
                    <div class="">
                        <select name="category_id" id="" class="form-select h-100">
                            <option value="">All</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(request()->get('category_id') == $category->id)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="">
                        <div class="input-icon">
                          <input
                            type="text"
                            class="form-control"
                            placeholder="Search for..."
                            name="search_term"
                            value="{{ request()->get('search_term') }}"
                          />
                          <span class="input-icon-addon">
                            <i class="fa fa-search"></i>
                          </span>
                        </div>
                    </div>
                    {{-- <input type="text" name="search_term" value="{{ request()->get('search_term') }}" placeholder="Search ..." class="form-control"> --}}
                    <button class="btn btn-primary btn-sm"><i class="fas fa-search"></i></button>
                </div>
            </div>

        </form>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Account</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this account? It can't be undo.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" id="modalDeleteBtn">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-cols-3">
            @foreach ($thesisProjects as $key => $project)
            <div class="col">
                <div class="card card-post card-round">
                    <div class="card-img-top position-relative" style="height: 230px;">
                        <x-image src="{{ 'storage/uploads/project/'.$project->images[0]->path }}" class="w-100 h-100 rounded-top-3"/>
                        @if ($project->status == 1)
                        <span class="position-absolute top-0 end-0 m-3 fs-6 border border-white badge rounded-pill bg-success text-white">Active</span>
                        @elseif ($project->status == 2)
                        <span class="position-absolute top-0 end-0 m-3 fs-6 border border-white badge rounded-pill bg-warning text-dark">Pending</span>
                        @else
                        <span class="position-absolute top-0 end-0 m-3 fs-6 border border-white badge rounded-pill bg-danger text-white">Rejected</span>
                        @endif
                    </div>
                    <div class="card-body">
                      <div class="d-flex">
                        <div class="avatar">
                            <x-image src="{{ 'storage/uploads/profile/'.$project->owner->profile_photo_path }}" class="avatar-img rounded-circle" />
                        </div>
                        <div class="info-post ms-2">
                          <p class="username">{{ $project->owner->name }}</p>
                          <p class="date text-muted">{{ $project->created_at->format('d/m/Y') }}</p>
                        </div>
                      </div>
                      <div class="separator-solid"></div>
                      <p class="card-category text-info mb-1">
                        <span>{{ $project?->category?->name }}</span>
                      </p>
                      <h3 class="card-title">
                        <span> {{ $project->title }} </span>
                      </h3>
                      <div class="" style="min-height: 130px;">
                        <p class="card-text">
                            {!! Str::limit($project->description, 100, '...') !!}
                          </p>
                      </div>
                      <a href="#" class="btn btn-primary btn-rounded btn-sm"
                        >Read More</a
                      >
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <table class="d-none table table-striped table-hover mt-3">
            <thead>
                <tr>
                    <th scope="col">Action</th>
                    <th scope="col">No.</th>
                    <th scope="col">Cover</th>
                    <th scope="col">Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Owner</th>
                    <th scope="col">Created Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($thesisProjects as $key => $project)
                    <tr>
                        <input type="hidden" id="userId" value="{{ $project->id }}">
                        <td>
                            <a href="{{ route('thesis.edit', $project->id) }}" class="btn btn-primary"><i class="fa-solid fa-pencil"></i></a>
                            <button class="btn btn-outline-danger deleteBtn" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-trash"></i></button>
                        </td>
                        <th scope="row">{{ ($thesisProjects->currentPage() * $thesisProjects->perPage()) - $thesisProjects->perPage() + $key + 1 }}</th>
                        <td>
                            <x-image src="{{ 'storage/uploads/project/'.$project->images[0]->path }}" style="width:40px; height:40px;" />
                        </td>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project?->category?->name }}</td>
                        <td>{{ $project->owner->name }}</td>
                        <td>{{ $project->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="float-end">
            {{ $thesisProjects->links() }}
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $userId = '';
            $('.deleteBtn').click(function(){
                $parentNode = $(this).parents('tr');
                $userId = $parentNode.find('#userId').val();
            })
            $('#modalDeleteBtn').click(function(){
                $.ajax({
                    type: 'get',
                    url: 'teacher/'+$userId+'/delete',
                    dataType: 'json',
                    success: function(res){
                        if(res.status == 'success'){
                            location.reload();
                        }
                    }
                })
            })

        })
    </script>
@endsection
