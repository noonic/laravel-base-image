@extends('noonic_image::iframe')

@section('content')
    <h3 class="mt10">Done!</h3>

    <hr />

    @include('noonic_image::error')

    <div class="cropper-content">
        <div class="col-sm-12 text-center" style="margin-top: 15%;">

            <p><img src="{{ $url }}" style="max-width: 300px;"/></p>

            <p class="tx accent1 large mt30"><i class="fa fa-check"></i> Image was uploaded and cropped successfully.</p>

        </div>
    </div>

    <script>
        $(function() {
            window.parent.$('#{{ $id }}').val('{{ $directory.'/'.$image }}');
            window.parent.$('#{{ $id }}-preview').attr('src', '{{ $url }}').fadeIn();

            setTimeout(function() {
                window.parent.$('#image-uploader').modal('hide');
            }, 2000);
        })
    </script>
@endsection