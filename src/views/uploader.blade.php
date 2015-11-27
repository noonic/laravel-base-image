@extends('noonic_image::iframe')

@section('content')
    <h3 class="mt10">Select Image</h3>

    <hr />

    @include('noonic_image::error')

    <div class="cropper-content">
        <div class="col-sm-12 text-center" style="margin-top: 15%;">
            {!! Form::open(['route' => ['image_upload_image'], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-4">
                        {!! Form::file('image', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                {!! Form::hidden('target', $target) !!}
                {!! Form::hidden('id', $id) !!}
                {!! Form::hidden('folder', $folder) !!}
                {!! Form::hidden('ratio', "4/3", ['id' => 'ratio']) !!}

                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-4">
                        {!! Form::submit('Submit', ['class'=>'btn btn-block btn-primary']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>

    <script>
        $(function(){
            var ratio = window.parent.$('#{{ $id }}-ratio').val();
            if(typeof ratio != 'undefined' && ratio != '') {
                $('#ratio').val(ratio);
            }
        });
    </script>
@endsection