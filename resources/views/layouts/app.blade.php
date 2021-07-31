<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.head')
</head>
    <body>

		<!-- Main Wrapper -->
        <div class="main-wrapper">

            @include('layouts.header')

            @include('layouts.sidebar')

            @section('main-content')
            @show

        </div>
		<!-- /Main Wrapper -->

    @include('layouts.partials.script')

    </body>

<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:34 GMT -->
</html>

<form id="logout_form" action="{{ route('logout') }}" method="POST">
    @csrf
</form>
