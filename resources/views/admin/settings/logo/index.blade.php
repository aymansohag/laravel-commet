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
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">Add Logo</h4>
                    </div>
                    <div class="card-body">
                        @include('validation')
                        <form action="{{ route('logo.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-goroup">
                                <img style="display: block; width: 250px; height: 82px" class="bg-dark" src="{{ URL::to('/') }}/media/settings/{{ $logo -> logo_name }}" alt="">
                                <br>
                                <img src="" id="logo-dark-load">
                                <label for="logo-lite">
                                    <i class="fa fa-file-image-o" style="cursor: pointer; font-size: 50px; color: #00d0f1"></i>
                                </label>
                                <input class="d-none" type="file" name="logo" id="logo-lite">
                                <input value="{{ $logo -> logo_name }}" type="hidden" name="old_logo">
                            </div>
                            <br>
                            <div class="form-group row">
                                <label class="col-lg-3 form-lebel" for="">Logo Width</label>
                                <input class="form-control col-lg-9" type="text" name="logo_width" value="{{ $logo -> logo_width }}">
                            </div>
                            <br>
                            <div class="form-group">
                                <input type="submit" class="btn btn-info" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Page Wrapper -->
@endsection
