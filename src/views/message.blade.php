<div class="display-none messages" id="messages">
    <div class="ml10 mr10 alert alert-success">
        <p>
            <span class="message-text">
                @if (Session::has('message'))
                    {!! Session::get('message') !!}
                @endif
            </span>

            <a href="javascript:void(0);" onclick="App.Helper.Alert.dismiss();" class="pull-right tx grey2"><i class="fa fa-times"></i></a>
        </p>
    </div>
</div>

@if (Session::has('message'))
    <script type="text/javascript">
        $(function() {
            Noonic.Images.Alert.show();
        });
    </script>
@endif