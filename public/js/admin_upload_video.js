// VIDEO UPLOAD start
var formatArray = [
    'video/quicktime',
    'video/mp4',
    'application/mp4',
    'video/x-msvideo',
    'application/x-troff-msvideo',
    'video/avi',
    'video/msvideo',
    'audio/mpeg3',
    'audio/x-mpeg-3',
    'video/x-mpeg',
    'video/mpeg'
];

var uploadStatus = 0;

$('#add_files').click(function () {
    $('#new_file').click();
});


var files_upload = [];
var nr_file = 0;

$('#new_file').change(function (data) {
    var file = data.target.files,
        count = file.length,
        classDiv;

    if (count > 0) {
        var filename = file[0].name,
            size = file[0].size / 1024, // w kb
            type = file[0].type;

        $.each(file, function (k, v) {
            files_upload[nr_file] = file[k];

            if (formatArray.indexOf(file[k].type) == -1) {
                var file_name_format = file[k].name.split('.');
                var file_format = file_name_format[file_name_format.length - 1];
                if (file_format != 'psd') {
                    classDiv = 'error-type';
                    var old_nr = nr_file;
                    delete_file(old_nr, 2);
                }
            } else {
                classDiv = '';
            }

            $('#files_list').append('<div data-file-content="' + nr_file + '" class="one_file__container ' + classDiv + '"> <div class="one_file__container--content"> <span class="noselect filename_trim">' + file[k].name + '</span> <span class="noselect">' + file[k].type + ' &bull; ' + get_size(file[k].size) + '</span> </div> <span onClick="delete_file(' + nr_file + ', 1);" class="delete_file noselect">X</span> </div>');

            nr_file++;
        });

    }

});


function get_size(size) {
    // dostaje w bajtach!
    var level = 1, size_name;
    while (size > 1024) {
        size = size / 1024;
        level++;
    }

    if (level == 1) {
        size_name = ' B';
    } else if (level == 2) {
        size_name = ' kB';
    } else if (level == 3) {
        size_name = ' MB';
    } else if (level == 4) {
        size_name = ' GB';
    } else if (level == 5) {
        size_name = ' TB';
    }

    return size.toFixed(2) + size_name;
}


function delete_file(nr_file, from) {
    files_upload.splice(nr_file, 1);

    if (from == 1) {
        $('[data-file-content="' + nr_file + '"]').remove();
    } else if (from == 2) {
        setTimeout(function () {
            $('[data-file-content="' + nr_file + '"]').remove();
        }, 3000);
    }

    validate_transfer();
}


function validate_transfer() {
    var count = files_upload.length;
    var status = 1;
    var status_info = {};

    if (count < 1) {
        status = 0;
        status_info[0] = {
            'where': 'add_files',
            'text': 'Musisz dodać pliki'
        }
    }

    if (status == 1) {
        return 1;
    } else {
        add_error_message(status_info);
        return 0;
    }
}


function add_error_message(status_info) {
    $.each(status_info, function (k, v) {
        $('#' + v['where']).attr('data-original-title', v['text']).tooltip('show');
    });
}


$('#btn_transfer').click(function () {
    var status = validate_transfer();

    if (parseInt(status) === 0) {
        console.log('cos nie tak..');
    } else if (parseInt(status) === 1 && uploadStatus === 0) {
        uploadStatus = 1;
        send_file();
    }
});



var file_to_upload,
    arrayKey = [],
    totalWeight = 0,
    readyWeight = 0,
    realWeightReady = 0,
    nowWeightFile = 0,
    record,
    uploadHash;


function send_file() {
    file_to_upload = files_upload;

    $.each(file_to_upload, function (key, value) {
        if (value != null && value != 'undefined') {
            arrayKey.push(key);
            totalWeight += value.size;
        }
    });

    setTimeout(function () {
        var link_uploader_view = $('#view_link').val();
        $('#container, #files_list').fadeOut(200);
        $('#container').html('');
        if (status !== 0) {
            uploadHash = status;
            $('#container').load(link_uploader_view).fadeIn(200);
            upload_one_file(arrayKey[0], 0);
        }
    }, 200);
}

function upload_one_file(key_file, keyArray) {
    var formData = new FormData();
    formData.append('file_data', file_to_upload[key_file]);
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    $.ajax({
        type: "POST",
        url: $('#upload_link').val(),
        data: formData,
        processData: false,
        contentType: false,
        xhr: function () {
            //upload Progress bar
            var xhr = $.ajaxSettings.xhr();
            if (xhr.upload) {
                xhr.upload.addEventListener('progress', function (event) {
                    var position = event.loaded || event.position;
                    var total = event.total;
                    nowWeightFile = total;

                    realWeightReady = readyWeight + position;
                    var progress_percent = Math.ceil((realWeightReady * 100) / totalWeight);
                    if (progress_percent > 100) {
                        progress_percent = 100;

                        $('#upload_text').html('Trwa właśnie przenoszenie plików. Przykładowo przeniesienie 7 GB pliku trwa ok. 45 sekund');
                    }

                    $('#progress_bar').css('width', progress_percent+'%').html(progress_percent+'% Complete (success) ---- ' + get_size(realWeightReady) + '  / ' + get_size(totalWeight));

                }, true);
            }

            return xhr;
        }, success: function (response_json) {
            var response = JSON.parse(response_json);
            if (parseInt(response.status) === 0) {
                location.reload();
            }

            var next_key = parseInt(keyArray) + 1;
            if (arrayKey[next_key] != null && arrayKey[next_key] != 'undefined') {
                upload_one_file(arrayKey[next_key], next_key);
            } else {
                $('#how_now_file').html(get_size(totalWeight));
                window.location.href = $('#video_list_link').val();
            }

            readyWeight += nowWeightFile;
        }
    });
}































