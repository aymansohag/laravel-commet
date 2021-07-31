@extends('layouts.app')
@section('main-content')

<!-- Page Wrapper -->
<div class="page-wrapper">

    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Welcome @if (isset(Auth::user() -> name))
                        {{ Auth::user() -> name }}
                    @endif!</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        @php
        $all_slider_data = json_decode($slider -> sliders);
        @endphp

        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">Home Page Slider</h4>
                    </div>
                    <div class="card-body">
                        @include('validation')
                        <div>
                            <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Slider Video</label>
                                    <div class="col-lg-9">
                                        <input name="svideo" value="{{ $all_slider_data -> svideo }}" type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"></label>
                                    <div class="col-lg-9">
                                        <div class="commet-slider-container">
                                            @foreach ($all_slider_data -> slider as $slide)
                                            <div class="card" id="slider-card-{{ $slide -> slide_code }}">
                                                <div style="cursor: pointer" data-toggle="collapse" data-target="#slider-{{ $slide -> slide_code }}" class="card-header">
                                                    <h5>#Slider-{{ $slide -> slide_code }}
                                                        <button id="commet-slide-remove-btn" remove-id="{{ $slide -> slide_code }}" class="close">×</button>
                                                    </h5>
                                                </div>
                                                <div class="collapse" id="slider-{{ $slide -> slide_code }}">
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label for="">Sub Title</label>
                                                            <input type="hidden" name="slide_code[]" value="{{ $slide -> slide_code }}" class="form-control">
                                                            <input type="text" value="{{ $slide -> subtitle }}" name="subtitle[]" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Title</label>
                                                            <input name="title[]" value="{{ $slide -> title }}" type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Button 1 Title</label>
                                                            <input value="{{ $slide -> btn1_title }}" name="btn1_title[]" type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Button 1 Link</label>
                                                            <input name="btn1_link[]" value="{{ $slide -> btn1_link }}" type="text" class="form-control">
                                                        </div><div class="form-group">
                                                            <label for="">Button 2 Title</label>
                                                            <input name="btn2_title[]" value="{{ $slide -> btn2_title }}" type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Button 2 LInk</label>
                                                            <input name="btn2_link[]" value="{{ $slide -> btn2_link }}" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Add Slide</label>
                                    <div class="col-lg-9">
                                        <button id="commet-add-slide" class="btn btn-primary">Add New Slide</button>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col text-right">
                                        <input type="submit" class="btn btn-info" value="Save Slider">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Page Wrapper -->
@endsection
