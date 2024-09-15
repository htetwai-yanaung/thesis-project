@extends('core::layouts.master')

@section('content')
    <div class="">
        <h1 class="fw-bold mb-3">News List</h1>
        <div class="row justify-content-end mb-3">
            <div class="col-3">
                <a href="{{ route('announcement.create') }}" class="btn btn-primary float-end">
                    <span class="btn-label">
                      <i class="fas fa-plus"></i>
                    </span>
                    Create A News
                </a>
            </div>
        </div>
        <form action="{{ route('announcement.index') }}" method="GET" class="row mb-3">
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
                        <h5 class="modal-title" id="exampleModalLabel">Delete News</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this news? It can't be undo.
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
                        <th scope="col">Cover</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Added Date</th>
                        <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($news as $key => $article)
                    <tr>
                        <input type="hidden" id="categoryId" value="{{ $article->id }}">
                        <th scope="row">{{ ($news->currentPage() * $news->perPage()) - $news->perPage() + $key + 1 }}</th>
                        <td>
                            @if (count($article->images) > 0)
                            <div class="avatar avatar-sm">
                                <x-image src="{{ 'storage/uploads/news/'.$article->images[0]->path }}" alt="..." class="avatar-img rounded-circle" />
                            </div>
                                {{-- <x-image src="{{ 'storage/uploads/news/'.$n->images[0]->path }}" style="width:40px; height:40px;" /> --}}
                            @endif
                        </td>
                        <td>
                            {{ $article->title }}
                        </td>
                        <td class="w-25">
                            {!! Str::limit($article->description, 100, '...') !!}
                        </td>
                        {{-- <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="status" @checked($article->status == 1)>
                            </div>
                        </td> --}}
                        <td>{{ $article->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="">
                                <a href="{{ route('category.edit', $article->id) }}" type="button" class="btn btn-icon btn-round btn-success" >
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
                {{ $news->links() }}
              </div>
            </div>
        </div>

        <table class="table table-striped table-hover mt-3 d-none">
            <thead>
                <tr>
                    <th scope="col">Action</th>
                    <th scope="col">No.</th>
                    <th scope="col">Cover</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Created Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($news as $key => $n)
                    <tr>
                        <input type="hidden" id="userId" value="{{ $n->id }}">
                        <td>
                            <a href="{{ route('announcement.edit', $n->id) }}" class="btn btn-primary"><i class="fa-solid fa-pencil"></i></a>
                            <button class="btn btn-outline-danger deleteBtn" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-trash"></i></button>
                        </td>
                        <th scope="row">{{ ($news->currentPage() * $news->perPage()) - $news->perPage() + $key + 1 }}</th>
                        <td>
                            @if (count($n->images) > 0)
                                <x-image src="{{ 'storage/uploads/news/'.$n->images[0]->path }}" style="width:40px; height:40px;" />
                            @endif
                        </td>
                        <td>{{ $n->title }}</td>
                        <td >
                            <div class="ck-content">
                                {!! $n->description !!}
                            </div>
                        </td>
                        <td>{{ $n->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="float-end">
            {{ $news->links() }}
        </div>
    </div>
@endsection
