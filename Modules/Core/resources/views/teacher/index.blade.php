@extends('core::layouts.master')

@section('content')
    <div class="">
        <h3 class="fw-bold mb-3">Teachers List</h3>
        <form action="{{ route('teacher.index') }}" method="GET" class="row mb-3">
            {{-- @csrf --}}
            <div class="d-flex">
                <div class="ms-auto d-flex gap-2">
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
                    {{-- <button class="btn btn-primary btn-sm"><i class="fas fa-search"></i></button> --}}
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

        <div class="card">
            <div class="card-header">
              <h4 class="card-title">Basic</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table
                  id="basic-datatables"
                  class="display table table-striped table-hover"
                >
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Profile</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Joined date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($teachers as $key => $teacher)
                    <tr>
                        <th scope="row">{{ ($teachers->currentPage() * $teachers->perPage()) - $teachers->perPage() + $key + 1 }}</th>
                        <td>
                            <div class="avatar avatar-sm">
                                <x-image src="{{ 'storage/uploads/profile/'.$teacher->profile_photo_path }}"
                                    default="{{ 'images/images.png' }}" alt="..." class="avatar-img rounded-circle" />
                            </div>
                        </td>
                        <td>{{ $teacher->name }}</td>
                        <td>{{ $teacher->email }}</td>
                        <td>{{ $teacher->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="">
                                {{-- <a href="{{ route('profile.edit', $teacher->id) }}" class="btn btn-primary"><i class="fa-solid fa-pencil"></i></a> --}}
                            {{-- <button class="btn btn-outline-danger deleteBtn" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-trash"></i></button> --}}
                                <a href="{{ route('profile.edit', $teacher->id) }}" type="button" class="btn btn-icon btn-round btn-success" >
                                    <i class="icon-pencil"></i>
                                </a>
                                <button type="button" class="btn btn-icon btn-round btn-danger deleteBtn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="icon-trash"></i>
                                </button>
                            </div>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="float-end">
                {{ $teachers->links() }}
              </div>
            </div>
        </div>

        {{-- <table class="table table-striped table-hover mt-3">
            <thead>
                <tr>
                    <th scope="col">Action</th>
                    <th scope="col">No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Joined Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teachers as $key => $teacher)
                    <tr>
                        <input type="hidden" id="userId" value="{{ $teacher->id }}">
                        <td>
                            <a href="{{ route('profile.edit', $teacher->id) }}" class="btn btn-primary"><i class="fa-solid fa-pencil"></i></a>
                            <button class="btn btn-outline-danger deleteBtn" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-trash"></i></button>
                        </td>
                        <th scope="row">{{ ($teachers->currentPage() * $teachers->perPage()) - $teachers->perPage() + $key + 1 }}</th>
                        <td>{{ $teacher->name }}</td>
                        <td>{{ $teacher->email }}</td>
                        <td>{{ $teacher->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="float-end">
            {{ $teachers->links() }}
        </div> --}}
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
