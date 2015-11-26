Noonic = {
    Images: {
        openUploader: function (target, id, folder) {
            $('#image-uploader').modal('show');
            $('#image-uploader').on('shown.bs.modal', function (e) {
                $('#image-uploader iframe').attr('src', urlBase + '/image/uploader/' + target + '/' + id + '/' + folder);
            });
            $('#image-uploader').on('hidden.bs.modal', function (e) {
                $('#image-uploader iframe').attr('src', urlBase + '/image/loading');
            });
        }
    },

    Alert: {
        show: function (message) {
            message = (typeof message != 'undefined') ? message : '';
            if(message != '') {
                $('#messages').find('.message-text').html(message);
            }

            $('#messages').fadeIn();

            setTimeout(function () {
                $('#messages').fadeOut();
            }, 7000);
        },

        dismiss: function () {
            $('#messages').hide();
        }
    },
}