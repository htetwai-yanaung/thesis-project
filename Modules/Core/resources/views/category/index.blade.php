@extends('core::layouts.master')

@section('content')
<div class="">
    <h1>Category List</h1>
    <div class="row justify-content-end mb-3">
        <div class="col-3">
            <a href="{{ route('category.create') }}" class="btn btn-primary float-end">Create New Category</a>
        </div>
    </div>
    <form action="{{ route('category.index') }}" method="GET" class="d-flex justify-content-end">
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

    @if (session('success'))
        <p class="p-2 text-center text-white bg-success">{{ session('success') }}</p>
    @endif

    <table class="table table-striped table-hover mt-3">
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
