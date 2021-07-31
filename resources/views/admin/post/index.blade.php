@extends('layouts.app')
@section('main-content')

<!-- Page Wrapper -->
<div class="page-wrapper">

    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Welcome
                        @if ( isset( Auth::user() -> name) )
                         {{ Auth::user() -> name }}!
                        @endif
                    </h3>
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
                        <h4 class="card-title">All Post</h4>
                        <div>
                            <a href="#post_modal" data-toggle="modal" class="btn btn-info btn-sm">Add New Post</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('validation')
                        <div>
                            <table class="table data_table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Tags</th>
                                        <th>Featured Image</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                        <th style="width: 20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($all_data as $data)
                                        <tr>
                                            <td>{{ $loop -> index +1 }}</td>
                                            <td>{{ $data -> title }}</td>
                                            <td>
                                                @foreach ($data -> categories as $cat)
                                                    {{ $cat -> name }} |
                                                @endforeach
                                            </td>
                                            <td>{{ $data -> tag }}</td>
                                            <td>
                                                @if ( !empty($data -> featured_image) )
                                                    <img style="width: 60px; height: 45px" src="{{ URL::to('/') }}/media/posts/{{ $data -> featured_image }}" alt="">
                                                @endif
                                            </td>
                                            <td>{{ $data -> created_at -> diffForHumans() }}</td>
                                            <td>
                                                @if ($data -> status == 'Published')
                                                    <span class="badge badge-success">{{ $data -> status }}</span>
                                                @else
                                                    <span class="badge badge-danger">{{ $data -> status }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($data -> status == 'Published')
                                                   <a href="{{ route('post.unpublished', $data -> id) }}" class="btn btn-sm btn-danger">
                                                         <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                   </a>
                                                @else
                                                    <a href="{{ route('post.published', $data -> id) }}" class="btn btn-sm btn-success">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                     </a>
                                                @endif

                                                <a id="post_edit_id" edit_id="{{ $data -> id }}" href="" data-toggle="modal" class="btn btn-sm btn-warning">Edit</a>

                                                <form class="d-inline" action="{{ route('post.destroy', $data -> id) }}" method="POST">
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
    <div id="post_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Create Post</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input class="form-control" type="text" name="title" placeholder="Post Titile">
                        </div>
                        <div class="form-group">
                            <textarea name="content" id="post_editor1">

                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="" style="font-size: 20px">Categories</label>
                           @foreach ($all_cat as $cat)
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="{{ $cat -> id }}" name="category[]"> {{ $cat -> name }}
                                    </label>
                                </div>
                           @endforeach
                        </div>
                        <div class="form-group">
                            <img src="" id="post_featured_image_load" alt="" style="width: 100px; display: block; margin-bottom: 20px">
                            <label for="post_fimage">
                                <i class="fa fa-file-image-o" style="cursor: pointer; font-size: 44px; color: #00d0f1"></i>
                            </label>
                            <input style="display: none" type="file" name="fimage" id="post_fimage">
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
    <div id="post_modal_update" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Update Post</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('update.post') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input class="form-control" type="text" name="title" placeholder="Post Titile">
                            <input type="hidden" class="form-control" type="text" name="id" placeholder="tag Id">
                        </div>
                        <div class="form-group">
                            <textarea rows="15" name="content" class="form-control">

                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="" style="font-size: 20px">Categories</label>
                            <div class="post_cat_list">

                            </div>
                        </div>
                        <div class="form-group">
                            <img src="" id="post_featured_image_load_update" style="width: 100px; display: block; margin-bottom: 20px">
                            <label for="post_fimage_update">
                                <i class="fa fa-file-image-o" style="cursor: pointer; font-size: 44px; color: #00d0f1"></i>
                            </label>
                            <input style="display: none" type="file" name="fimage_update" id="post_fimage_update">
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
