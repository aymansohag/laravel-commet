@extends('layouts.app')
@section('main-content')

<!-- Page Wrapper -->
<div class="page-wrapper">

    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Welcome {{ Auth::user() -> name }}!</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">All Tag</h4>
                        <div>
                            <a href="#tag_modal" data-toggle="modal" class="btn btn-info btn-sm">Add New Tag</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('validation')
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tag Name</th>
                                        <th>Slug</th>
                                        <th>Status</th>
                                        <th style="width: 25%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($all_data as $data)
                                        <tr>
                                            <td>{{ $loop -> index +1 }}</td>
                                            <td>{{ $data -> name }}</td>
                                            <td>{{ $data -> slug }}</td>
                                            <td>
                                                @if ($data -> status == 'Published')
                                                    <span class="badge badge-success">{{ $data -> status }}</span>
                                                @else
                                                    <span class="badge badge-danger">{{ $data -> status }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($data -> status == 'Published')
                                                   <a href="{{ route('post-tag.unpublished', $data -> id) }}" class="btn btn-sm btn-danger">
                                                         <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                   </a>
                                                @else
                                                    <a href="{{ route('post-tag.published', $data -> id) }}" class="btn btn-sm btn-success">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                     </a>
                                                @endif

                                                <a id="tag_edit_id" edit_id="{{ $data -> id }}" href="#tag_modal_update" data-toggle="modal" class="btn btn-sm btn-warning">Edit</a>

                                                <form class="d-inline" action="{{ route('post-tag.destroy', $data -> id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{-- Add Tag --}}
    <div id="tag_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Create Tag</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('post-tag.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input class="form-control" type="text" name="name" placeholder="Tag Name">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Add Tag" class="btn btn-info">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- Update Tag --}}
    <div id="tag_modal_update" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Update Tag</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tag.update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input class="form-control" type="text" name="name" placeholder="Tag Name">
                            <input type="hidden" class="form-control" type="text" name="id" placeholder="tag Id">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Update Tag" class="btn btn-info">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Page Wrapper -->
@endsection
