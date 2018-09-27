$(function () {
    $('#public_date').datetimepicker({
        format: 'YYYY-MM-DD HH:mm',
        sideBySide: true
    });

    $('#date_from').datetimepicker({
        format: 'YYYY-MM-DD HH:mm',
        sideBySide: true
    });

    $('#date_to').datetimepicker({
        format: 'YYYY-MM-DD HH:mm',
        sideBySide: true
    });
});

$('#code_date_from').change(function () {
    if ($(this).is(":checked")) {
        $('#public_date').val('').attr('disabled', 'disabled');
    } else {
        $('#public_date').val(moment().format('YYYY-MM-DD HH:mm')).removeAttr('disabled', 'disabled');
    }
});

$('#check_price_us').change(function () {
    if ($(this).is(":checked")) {
        makeFreeOrPay(1);
    } else {
        makeFreeOrPay(2);
    }
});

function makeFreeOrPay(type) {
    if (type === 1) {
        $('#price_us').val('').attr('disabled', 'disabled');
        $('#price_ru').val('').attr('disabled', 'disabled');
        $('#price_arc').val('').attr('disabled', 'disabled');
    } else {
        $('#price_us').val('').removeAttr('disabled', 'disabled');
        $('#price_ru').val('').removeAttr('disabled', 'disabled');
        $('#price_arc').val('').removeAttr('disabled', 'disabled');
    }
}

$(document).ready(function () {
    var input_free_or_pay = $('#check_price_us');
    if (typeof input_free_or_pay.val() !== "undefined" && input_free_or_pay.val() != null) {
        if (input_free_or_pay.is(":checked")) {
            makeFreeOrPay(1);
        }
    }
});

$('#check_price_ru').change(function () {
    if ($(this).is(":checked")) {
        $('#price_ru').val('').attr('disabled', 'disabled');
    } else {
        $('#price_ru').val('').removeAttr('disabled', 'disabled');
    }
});

$('#check_price_arc').change(function () {
    if ($(this).is(":checked")) {
        $('#price_arc').val('').attr('disabled', 'disabled');
    } else {
        $('#price_arc').val('').removeAttr('disabled', 'disabled');
    }
});

$(".js-example-basic-multiple").select2();

$('[data-price]').click(function () {
    $('input[name="price"]').val($(this).attr('data-price'));

    $('[data-price]').removeClass('btn-primary').addClass('btn-default');
    $(this).removeClass('btn-default').addClass('btn-primary');
});

$('#del_video_thumb').click(function () {
    $('#video_thumb_container').html('<input class="form-control" name="image" type="file" /><p><span class="glyphicon glyphicon-info-sign"></span> Nie jest wymagane</p>');
});

$('#del_event_og').click(function () {
    $('#event_og_image').html('<input class="form-control" name="open_graph_image" type="file" /><p><span class="glyphicon glyphicon-info-sign"></span> Nie jest wymagane</p>');
});

$('#generate_code').click(function () {
    var text = "";
    var possible = "abcdefghijklmnopqrstuvwxyz0123456789";
    for (var i = 0; i < 7; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    if (typeof checkPromoCode !== "undefined" && checkPromoCode != null) {
        $('#code').val(text);
    } else{
        $('#promo_code').val(text);
    }
});

$('#code_type').change(function () {
    setCodeType(parseInt($(this).val()));
});

$('#for_what_code').change(function () {
    setWhatCode(parseInt($(this).val()));
});


function setCodeType(type) {
    if(type == 1){
        $('#code_content').show();
        $('#promo_code').removeAttr('disabled');
    } else{
        $('#code_content').hide();
        $('#promo_code').attr('disabled', 'disabled');
    }
}

function setWhatCode(type){
    if(type == 1){
        $('#code_event').show();
        $('#code_event').removeAttr('disabled');
        $('#code_days').hide();
        $('#code_days').attr('disabled', 'disabled');
        $('#for_what_title').html('Wybierz event');
    } else{
        $('#code_days').show();
        $('#code_days').removeAttr('disabled');
        $('#code_event').hide();
        $('#code_event').attr('disabled', 'disabled');
        $('#for_what_title').html('Ile dni?');
    }
}

$(document).ready(function () {
    if (typeof checkPromoCode !== "undefined" && checkPromoCode != null) {
        setCodeType(parseInt($('#code_type').val()));
        setWhatCode(parseInt($('#for_what_code').val()));
    }
});

$('[data-video-id]').click(function () {
    var idProposition = parseInt($(this).attr('data-prop-id'));
    if (idProposition === 0) {
        $('[data-video-id-input="' + $(this).attr('data-video-id') + '"]').val(0);
        $('[data-title-video="' + $(this).attr('data-video-id') + '"]').val('');
    } else {
        $('[data-video-id-input="' + $(this).attr('data-video-id') + '"]').val($(this).attr('data-prop-id'));
        $('[data-title-video="' + $(this).attr('data-video-id') + '"]').val($(this).attr('data-prop-title'));
    }
});

$(document).ready(function () {
    var inputForCheck = $('[data-check-checkbox]').val();

    if (typeof inputForCheck !== "undefined" && inputForCheck != null) {
        if (inputForCheck === '') {
            $('[data-check-click]').click();

        }
    }
});

$('[data-old-tags]').click(function () {
    var tagId = $(this).attr('data-old-tags');
    var checkbox = $('[data-old-tags]').children('[value="'+ tagId +'"]');

    if(checkbox.is(':checked')){
        $(this).removeClass('opacity_tag');
    } else{
        $(this).addClass('opacity_tag');
    }
});

$('[data-prop-tags]').click(function () {
    var tagName = $(this).attr('data-prop-tags');
    var checkbox = $('[data-prop-tags]').children('[value="'+ tagName +'"]');

    if(checkbox.is(':checked')){
        $(this).removeClass('opacity_tag');
    } else{
        $(this).addClass('opacity_tag');
    }
});

$(".js-example-tokenizer").select2({
    tags: false,
    tokenSeparators: [',', ' ']
});

$(".js-example-tags").select2({
    tags: true
});



$('[data-price-uploaded]').click(function () {
    $('input[name="price[' + $(this).attr('data-price-uploaded') + ']"]').val($(this).attr('data-price-up'));


    $('[data-price-uploaded="' + $(this).attr('data-price-uploaded') + '"]').removeClass('btn-primary').addClass('btn-default');
    $(this).removeClass('btn-default').addClass('btn-primary');
});

$(document).ready(function () {
    var inputTags = $('.checkbox_tag');
    if(typeof inputTags.val() !== 'undefined' && inputTags.val() != null){
        for (var i = 0; i < inputTags.length; i++){
            if (inputTags.eq(i).prop('checked')) {
                inputTags.eq(i).parent().removeClass('opacity_tag');
            }
        }
    }
});

$(function () {
    $('[data-toggle="popover"]').popover();
});




























