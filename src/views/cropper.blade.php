@extends('noonic_image::iframe')

@section('css_head')
    <link href="{{ URL::asset('css/jquery.jcrop.min.css') }}" rel="stylesheet" />
    <style>
        .jcrop-holder {
            margin: 0px auto;
        }
    </style>
@endsection

@section('js_head')
    <script src="{{ URL::asset('js/jquery.jcrop.min.js') }}"></script>
@endsection

@section('content')
    <h3 class="mt10">Crop Image</h3>

    <hr />

    @include('noonic_image::error')

    <div class="cropper-content">
        <div class="col-sm-12 text-center">
            <img src="/images/uploads{{ $directory.'/'.$image  }}" id="image"/>

            {!! Form::open(['route' => ['image_crop'], 'class' => 'mt20 form-horizontal', 'onsubmit' => 'return cropperCheckSelection();']) !!}
                {!! Form::hidden('x', null, ['id' => 'x']) !!}
                {!! Form::hidden('y', null, ['id' => 'y']) !!}
                {!! Form::hidden('w', null, ['id' => 'w']) !!}
                {!! Form::hidden('h', null, ['id' => 'h']) !!}

                {!! Form::hidden('target', $target) !!}
                {!! Form::hidden('id', $id) !!}
                {!! Form::hidden('directory', $directory) !!}
                {!! Form::hidden('image', $image) !!}
                {!! Form::hidden('ratio', null, ['id' => 'ratio']) !!}
                {!! Form::hidden('preview_size', null, ['id' => 'preview-size']) !!}

                <a href="{{ route('image_uploader', ['target' => $target, 'id' => $id, 'folder' => $folder]) }}" class="btn grey-reverse">Back</a>
                {!! Form::submit('Crop', ['class'=>'btn btn-success']) !!}
            {!! Form::close() !!}

        </div>
    </div>

    <script>
        $(function(){
            var ratio = window.parent.$('#{{ $id }}-ratio').val();
            if(typeof ratio == 'undefined' || ratio == '') {
                ratio = '4/3';
            }
            $('#ratio').val(ratio);
            ratio = ratio.split('/');
            $('#image').Jcrop({
                onSelect: function updateCoords(c) {
                    $('#x').val(c.x);
                    $('#y').val(c.y);
                    $('#w').val(c.w);
                    $('#h').val(c.h);
                },
                bgColor: 'black',
                bgOpacity: .4,
                boxHeight: 360,
                setSelect: [400, 300, 0, 0],
                minSize: [400,300],
                aspectRatio: Number(ratio[0])/Number(ratio[1])
            });

            var previewSize = window.parent.$('#{{ $id }}-preview-size').val();
            $('#preview-size').val(previewSize);
        });
        function cropperCheckSelection() {
            if (parseInt($('#w').val())) return true;
            alert('Please select a crop region then press submit.');
            return false;
        };
    </script>
@endsection