<?php
    $data = isset($data) ? $data : '';
    $folder = isset($folder) ? $folder : 'mix';
    $id = isset($id) ? $id : $name;
    $previewSize = isset($previewSize) ? $previewSize : 't';
    $required = isset($required) ? $required : false;
?>

@if($data != '')
    <img src="{{ getImageUrl($data, $previewSize) }}" alt="{{ $id }}" id="{{ $id }}-preview" class="mb15 img-responsive thumbnail"/>
@else
    <img alt="{{ $id }}" id="{{ $id }}-preview" class="mb15 img-responsive thumbnail" style="display: none;"/>
@endif

<p><button onclick="Noonic.Images.openUploader('{{ $name }}', '{{ $id }}', '{{ $folder }}');" class="btn btn-default upload-button" type="button">Upload</button></p>

{!! Form::hidden($name, $data, ['id' => $id]) !!}
{!! Form::hidden($id.'-ratio', isset($ratio) ? $ratio : '4/3', ['id' => $id.'-ratio']) !!}
{!! Form::hidden($id.'-preview-size', $previewSize, ['id' => $id.'-preview-size']) !!}

@include('noonic_image::_modal')

@if($required)
    <script>
        $(function() {
            $('#{{ $id }}').parents('form').eq(0).on('submit', function() {
                var imageLink = $('#{{ $id }}').val();
                if(imageLink == '') {
                    alert("Please upload an image");
                    return false;
                }
            });
        });
    </script>
@endif