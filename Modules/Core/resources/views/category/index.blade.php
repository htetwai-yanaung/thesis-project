@extends('core::layouts.master')

@section('content')
<div class="">
    <h3 class="fw-bold mb-3">Category</h3>
    <div class="row justify-content-end mb-3">
        <div class="col-3">
            <a href="{{ route('category.create') }}" class="btn btn-primary float-end">
                <span class="btn-label">
                  <i class="fas fa-plus"></i>
                </span>
                Create New Category
            </a>
            {{-- <a href="{{ route('thesis.create') }}" class="btn btn-primary float-end">Create New Project</a> --}}
        </div>
    </div>
    <form action="{{ route('category.index') }}" method="GET" class="row mb-3">
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
                    <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this category? It can't be undo.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="modalDeleteBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>

    {{-- @if (session('success'))
        <p class="p-2 text-center text-white bg-success">{{ session('success') }}</p>
    @endif --}}

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
                    <th scope="col">No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Status</th>
                    <th scope="col">Added Date</th>
                    <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($categories as $key => $category)
                <tr>
                    <input type="hidden" id="categoryId" value="{{ $category->id }}">
                    <th scope="row">{{ ($categories->currentPage() * $categories->perPage()) - $categories->perPage() + $key + 1 }}</th>
                    <td>
                        {{ $category->name }}
                    </td>
                    <td>
                        {{ $category->description }}
                    </td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="status" @checked($category->status == 1)>
                        </div>
                    </td>
                    <td>{{ $category->created_at->format('d/m/Y') }}</td>
                    <td>
                        <div class="">
                            <a href="{{ route('category.edit', $category->id) }}" type="button" class="btn btn-icon btn-round btn-success" >
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
            {{ $categories->links() }}
          </div>
        </div>
    </div>

    <table class="table table-striped table-hover mt-3 d-none">
        <thead>
            <tr>
                <th scope="col">Action</th>
                <th scope="col">No.</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Status</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $key => $category)
                <tr>
                    <input type="hidden" id="categoryId" value="{{ $category->id }}">
                    <td>
                        <a href="{{ route('category.edit', $category->id) }}" class="btn btn-primary"><i class="fa-solid fa-pencil"></i></a>
                        <button class="btn btn-outline-danger deleteBtn" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-trash"></i></button>
                    </td>
                    <th scope="row">{{ ($categories->currentPage() * $categories->perPage()) - $categories->perPage() + $key + 1 }}</th>
                    <td>
                        {{ $category->name }}
                    </td>
                    <td>
                        {{ $category->description }}
                    </td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="status" @checked($category->status == 1)>
                        </div>
                    </td>
                    <td>{{ $category->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="float-end">
        {{ $categories->links() }}
    </div>
</div>
@endsection

@section('script')
<script>
    $('document').ready(function() {
        console.log('ready');
        $('input[name=status]').change(function() {
            $categoryId = '';
            $parentNode = $(this).parents('tr');
            $categoryId = $parentNode.find('#categoryId').val();
            $.ajax({
                type: 'put',
                url: `{{ route("category.updateStatus") }}`,
                data: {
                    'id': $categoryId
                },
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                success: (response) => {
                    console.log(response);
                }
            })
        })


        //delete
        $categoryId = '';
        $('.deleteBtn').click(function() {
            $parentNode = $(this).parents('tr');
            $categoryId = $parentNode.find('#categoryId').val();
        })
        $('#modalDeleteBtn').click(function(){
            $.ajax({
                type: 'get',
                url: `{{ route('category.delete') }}`,
                data: {
                    id: $categoryId
                },
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
