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
                        <h4 class="card-title">All Categories</h4>
                        <div>
                            <a href="#category_modal" data-toggle="modal" class="btn btn-info btn-sm">Add New Category</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('validation')
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Status</th>
                                        <th style="width: 25%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($all_cat as $cat)
                                        <tr>
                                            <td>{{ $loop -> index +1 }}</td>
                                            <td>{{ $cat -> name }}</td>
                                            <td>{{ $cat -> slug }}</td>
                                            <td>
                                                @if ($cat -> status == 'Published')
                                                    <span class="badge badge-success">{{ $cat -> status }}</span>
                                                @else
                                                    <span class="badge badge-danger">{{ $cat -> status }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($cat -> status == 'Published')
                                                   <a href="{{ route('post-gategory.unpublished', $cat -> id) }}" class="btn btn-sm btn-danger">
                                                         <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                   </a>
                                                @else
                                                    <a href="{{ route('post-gategory.published', $cat -> id) }}" class="btn btn-sm btn-success">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                     </a>
                                                @endif

                                                <a id="category_edit_id" edit_id="{{ $cat -> id }}" href="#category_modal_update" data-toggle="modal" class="btn btn-sm btn-warning">Edit</a>

                                                <form class="d-inline" action="{{ route('post-category.destroy', $cat -> id) }}" method="POST">
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
    {{-- Add Category --}}
    <div id="category_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Create Category</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('post-category.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input class="form-control" type="text" name="name" placeholder="Category Name">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Add Category" class="btn btn-info">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- Update Category --}}
    <div id="category_modal_update" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Update Category</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('category.update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input class="form-control" type="text" name="name" placeholder="Category Name">
                            <input type="hidden" class="form-control" type="text" name="id" placeholder="Category Id">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Update Category" class="btn btn-info">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Page Wrapper -->
@endsection
