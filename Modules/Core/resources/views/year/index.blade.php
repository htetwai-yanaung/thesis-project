@extends('core::layouts.master')

@section('content')
    <div class="">
        <h1 class="fw-bold mb-3">Year List</h1>
        {{-- <div class="row justify-content-end mb-3">
            <div class="col-3">
                <a href="{{ route('year.create') }}" class="btn btn-primary float-end">
                    <span class="btn-label">
                      <i class="fas fa-plus"></i>
                    </span>
                    Add Year
                </a>
            </div>
        </div> --}}
        <form action="{{ route('year.index') }}" method="GET" class="row mb-3">
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
                        <h5 class="modal-title" id="exampleModalLabel">Delete Year</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this year? It can't be undo.
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
                        <th scope="col">No.</th>
                        <th scope="col">Year</th>
                        <th scope="col">Status</th>
                        <th scope="col">Added Date</th>
                        <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($years as $key => $year)
                    <tr>
                        <input type="hidden" id="yearId" value="{{ $year->id }}">
                        <th scope="row">{{ ($years->currentPage() * $years->perPage()) - $years->perPage() + $key + 1 }}</th>
                        <td>
                            {{ $year->year }}
                        </td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="status" @checked($year->status == 1)>
                            </div>
                        </td>
                        <td>{{ $year->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="">
                                <a href="{{ route('year.edit', $year->id) }}" type="button" class="btn btn-icon btn-round btn-success" >
                                    <i class="icon-pencil"></i>
                                </a>
                                {{-- <button type="button" class="btn btn-icon btn-round btn-danger deleteBtn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="icon-trash"></i>
                                </button> --}}
                            </div>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="float-end">
                {{ $years->links() }}
              </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    $('document').ready(function() {
        console.log('ready');
        $('input[name=status]').change(function() {
            $yearId = '';
            $parentNode = $(this).parents('tr');
            $yearId = $parentNode.find('#yearId').val();
            $.ajax({
                type: 'put',
                url: `{{ route("year.updateStatus") }}`,
                data: {
                    'id': $yearId
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
        $yearId = '';
        $('.deleteBtn').click(function() {
            $parentNode = $(this).parents('tr');
            $yearId = $parentNode.find('#yearId').val();
        })
        $('#modalDeleteBtn').click(function(){
            $.ajax({
                type: 'get',
                url: `{{ route('year.delete') }}`,
                data: {
                    id: $yearId
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
