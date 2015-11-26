@extends('noonic_image::iframe')

@section('content')
    <h3 class="mt10">Please wait...</h3>

    <hr />

    @include('noonic_image::error')

    <div class="cropper-content">
        <div class="col-sm-12 text-center">
            <p class="tx accent1 large"><i class="fa fa-spinner fa-spin"></i> loading...</p>
        </div>
    </div>
@endsection