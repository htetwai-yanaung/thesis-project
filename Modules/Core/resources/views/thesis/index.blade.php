@extends('core::layouts.master')

@section('content')
    <div class="">
        <h1>Thesis Projects List</h1>
        <div class="row justify-content-end mb-3">
            <div class="col-3">
                <a href="{{ route('thesis.create') }}" class="btn btn-primary float-end">Create New Project</a>
            </div>
        </div>
        <form action="{{ route('thesis.index') }}" method="GET" class="row justify-content-end">
            {{-- @csrf --}}
            <div class="d-flex col-3 gap-2">
                <input type="text" name="search_term" value="{{ request()->get('search_term') }}" placeholder="Search ..." class="form-control">
                <button class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
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

        <table class="table table-striped table-hover mt-3">
            <thead>
                <tr>
                    <th scope="col">Action</th>
                    <th scope="col">No.</th>
                    <th scope="col">Cover</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
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
                            <img src="{{ asset('storage/uploads/project/'.$project->images[0]->path) }}" alt="" width="40px" height="40px" class="" style="width:40px; height:40px;">
                        </td>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->description }}</td>
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
