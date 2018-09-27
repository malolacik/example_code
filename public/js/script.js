$('.change_lang').click(function () {
    $('.flags__content').toggleClass('flags__height');
    if ($('.second_lang').hasClass('none')) {
        $('.second_lang').removeClass('none');
    } else {
        $('.second_lang').addClass('none');
    }
});

$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

$('.nav__bar').click(function () {
    $('.menu__body').toggleClass('menu__body--show');

    if ($(this).hasClass('fa-bars')) {
        $(this).addClass('fa-times');
        $(this).removeClass('fa-bars');
    } else {
        $(this).addClass('fa-bars');
        $(this).removeClass('fa-times');
    }


});

$('.user-nav__content').click(function () {
    $('.user-nav__content-more').toggleClass('user-nav__content--show');
});


$('.category__show-more--btn').click(function () {
    $(this).parent().parent().children('.category__list--hidden').toggleClass('category__list--show');
    $(this).parent().parent().children('.category__list--half-hidden').toggleClass('category__list--show');

    if ($(this).html() === 'SHOW MORE') {
        $(this).html('SHOW LESS');
    } else {
        $(this).html('SHOW MORE');
    }
});

$('.show__menu--btn').click(function () {
    $('.aside__block--xs').toggleClass('show_block_xs');
    $('.show__menu--btn-hide').toggle();
    $('.show__menu--btn-show').toggle();
    $('.search__content').removeClass('search__content--flex');
    $('.category__show-after-click').removeClass('show_category_xs');

    $('[data-show-category]').children('i').removeClass('fa-angle-up').removeClass('fa-angle-down');
    $('[data-show-category]').children('i').addClass('fa-angle-down');
});

$('[data-show-category]').click(function () {
    $(this).parent().children('.category__show-after-click').toggleClass('show_category_xs');

    if (parseInt($(this).attr('data-show-category')) === 1) {
        $(this).parent().toggleClass('search__content--flex');
    }


    if ($(this).children('i').hasClass('fa-angle-up')) {
        $(this).children('i').removeClass('fa-angle-up').removeClass('fa-angle-down');
        $(this).children('i').addClass('fa-angle-down');
    } else {
        $(this).children('i').removeClass('fa-angle-up').removeClass('fa-angle-down');
        $(this).children('i').addClass('fa-angle-up');
    }
});

$('.show_share').click(function () {
    $('.social-media').toggleClass('flex__video-function--sm--show');
});

$('.link_edit').click(function () {
    closeProposalSuccess();
    closeProposalError();
    $('.edit-video__container').toggleClass('edit-video__container--flex');
});

$('.add_tags').click(function () {
    $(this).toggleClass('add_tags--none');
    $('.add-tag__container').toggleClass('add-btn__tag--show');
    $('.input__tag').focus();
});

$('.close-tags').click(function () {
    $('.add_tags').removeClass('add_tags--none');
    $('.add-tag__container').removeClass('add-btn__tag--show');
});


$('#login_popup').click(function () {
    $('.pop_up-register--all-page').fadeIn();
    $('.pop_up-register').fadeIn();
    $("html, body").animate({scrollTop: "0"});
});

$('.btn_popup_close').click(function () {
    $('.pop_up-register--all-page').fadeOut();
    $('.pop_up-register').fadeOut();
});

$('.pop_up-register').click(function () {
    $('.btn_popup_close').click();
});

$('.pop_up-register--all-page').click(function () {
    $('.btn_popup_close').click();
});

$(document).keyup(function (e) {
    if (e.keyCode === 27) {
        $('.btn_popup_close').click();
        $('.close_modal_btn').click();
    }
});


$('.pop_up-register__container').click(function (e) {
    e.stopPropagation();
});


$('.hide-chat__btn').click(function () {
    $('.live-event__chat').toggleClass('chat-hidden');

    if ($('.btn-chat__show').hasClass('show__menu--btn-show')) {
        $('.btn-chat__show').removeClass('show__menu--btn-show').addClass('show__menu--btn-hide');
        $('.btn-chat__hide').removeClass('show__menu--btn-hide').addClass('show__menu--btn-show');
    } else {
        $('.btn-chat__hide').removeClass('show__menu--btn-show').addClass('show__menu--btn-hide');
        $('.btn-chat__show').removeClass('show__menu--btn-hide').addClass('show__menu--btn-show');
    }
});


function odl() {
    dd = dd + 1000;

    var sec = ((kk - dd) / 1000);
    var dni = ~~(sec / (3600 * 24));
    var godzin = ~~(sec / 3600) % 24;
    var minut = ~~(sec / 60) % 60;
    var sekund = ~~sec % 60;

    $('#countdown_event').html('<span class="number">' + dni + '</span><span class="letter">d</span><span class="number">' + godzin + '</span><span class="letter">h</span><span class="number">' + minut + '</span><span class="letter">m</span><span class="number">' + sekund + '</span><span class="letter">s</span>');

    // document.getElementById('event-time').innerHTML = '<span class="time-js">' + dni + '</span><span class="time-name">days</span><span class="time-js">' + godzin + '</span><span class="time-name">hours</span><span class="time-js">' + minut + '</span><span class="time-name">minutes</span><span class="time-js">' + sekund + '</span><span class="time-name">seconds</span>';
    if ((dni == 0 && godzin == 0 && minut == 0 && sekund == -2) || (kk - dd) < -2000) {
        window.location.reload();
    }
}

$(document).ready(function () {
    if (typeof countdown_event !== "undefined" && countdown_event != null) {
        odl();
        setInterval('odl()', 1000);
    }
});

$('[data-edit-btn]').click(function () {
    $('[data-edit-show]').removeClass('edit__hide');
    $('[data-edit-btn]').removeClass('edit__hide');
    $('[data-edit-hide]').addClass('edit__hide');


    var edit_input_number = $(this).attr('data-edit-btn');
    $('[data-edit-hide="' + edit_input_number + '"]').removeClass('edit__hide');
    $('[data-edit-show="' + edit_input_number + '"]').addClass('edit__hide');
    $(this).addClass('edit__hide');
    $('input[data-edit-hide="' + edit_input_number + '"]').select();
});

$('.modal__container').click(function () {
    $(this).fadeOut();
});

$('.close_modal_btn').click(function () {
    $('.modal__container').fadeOut();
});

$('.modal__container--content').click(function (e) {
    e.stopPropagation();
});

$('#pagination_videos').on('change', function () {
    window.location.href = $(this).val();
});


var socket = io.connect('https://my_site.com:3001', {secure: true});

$('#send_message').click(function () {
    sendChatMessage($('#message').val());
});

$("#message").on('keyup', function (e) {
    if (e.keyCode === 13) {
        sendChatMessage($(this).val());
    }
});

function sendChatMessage(message) {
    $('#message').val('');

    if (validateChatMessage(message)) {
        $.ajax({
            type: "POST",
            url: "/send-message",
            data: {
                message: message,
                event: $('#event').val(),
                x: $('#xxx').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function (response_json) {
            var response = JSON.parse(response_json);
            if (response.status == 1) {
                socket.emit('message', response_json);
            }
        });
    }
}

function validateChatMessage(message) {
    if (message.length > 250 || message.length < 1) {
        return 0;
    }
    return 1;
}

socket.on("message", function (data) {
    var response = JSON.parse(data);
    if (response.status == 1) {
        $('[data-event="' + response.event + '"]').append('<div data-mess="' + response.message_id + '" class="chat__one-message">\n' +
            '    <div class="one-message__message">\n' +
            '        <p class="one-message__message--text">\n' +
            '            <span class="one-message__message--username">' + response.username + '</span>\n' +
            '            ' + response.message + '\n' +
            '        </p>\n' +
            '        <span class="one-message__message--date">' + response.date + '</span>\n' +
            '    </div>\n' +
            '</div>');
        bottomScrollChatMessage();
    }
});


function bottomScrollChatMessage() {
    $('#chat_container').scrollTop($('[data-event]').height());
}


$(document).ready(function () {
    if (typeof $('#chat_container') !== "undefined" && $('#chat_container') != null) {
        bottomScrollChatMessage();
    }
});


var heightChatContainer = $('[data-event]').height();
var last_time = 0;
var new_time = Date.now();
$('#chat_container').scroll(function () {
    if ($('#chat_container').scrollTop() < 10) {
        $.ajax({
            type: "POST",
            url: "/get-chat-message",
            data: {
                event: $('#event').val(),
                last: $("#chat_container .chat__one-message:first-child").attr("data-mess"),
                _token: $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function (response_json) {
            var response = JSON.parse(response_json);
            if (response.status == 1) {
                last_time = Date.now();
                var diff_time = last_time - new_time;
                if (diff_time > 700) {
                    $.each(response.messages, function (key, value) {
                        $('[data-event="' + response.event + '"]').prepend('<div data-mess="' + value.id + '" class="chat__one-message">\n' +
                            '    <div class="one-message__message">\n' +
                            '        <p class="one-message__message--text">\n' +
                            '            <span class="one-message__message--username">' + value.username + '</span>\n' +
                            '            ' + value.message + '\n' +
                            '        </p>\n' +
                            '        <span class="one-message__message--date">' + value.created_at + '</span>\n' +
                            '    </div>\n' +
                            '</div>');
                    });

                    var new_height = $('[data-event]').height();
                    var dif = new_height - heightChatContainer;
                    $('#chat_container').scrollTop(dif);
                    heightChatContainer = new_height;
                    new_time = Date.now();
                }
            }
        });
    }
});

$('.buy_now_auth').click(function () {
    // $('#pay_paypal').click();
    $("html, body").animate({scrollTop: "0"});
});


function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).val()).select();
    document.execCommand("copy");
    $temp.remove();
    $(element).removeAttr('disabled').select().attr('disabled', 'disabled');
    show_flash();
}

$('[data-amount]').click(function () {
    $('#promo_amount').val($(this).attr('data-amount'));
    $('#promo_code_amount').html($(this).attr('data-amount'));
    $('#promo_code_arc').html($(this).attr('data-arc'));
});

$('#promo_code_btn_no').click(function (e) {
    e.preventDefault();
    $('.close').click();
});


$('[data-voting]').click(function () {
    $.ajax({
        type: "POST",
        url: "/video-voting",
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            video_id: $(this).attr('data-video'),
            vote: $(this).attr('data-voting')
        }
    }).done(function (response_json) {
        var response = JSON.parse(response_json);
        var btn_up = $('span[data-video="' + response.video_id + '"][data-voting="1"]');
        var btn_down = $('span[data-video="' + response.video_id + '"][data-voting="2"]');
        $('span[data-video="' + response.video_id + '"]').removeClass('voice').removeClass('no_voice');

        if (parseInt(response.status) === 1) {
            btn_up.addClass('voice');
            btn_down.addClass('no_voice');
        } else if (parseInt(response.status) === 2) {
            btn_down.addClass('voice');
            btn_up.addClass('no_voice');
        }

        btn_up.html('<i class="fa fa-thumbs-up" aria-hidden="true"></i> ' + response.rating_up);
        btn_down.html('<i class="fa fa-thumbs-down" aria-hidden="true"></i> ' + response.rating_down);
    });
});


$('#pay_paypal').click(function () {
    fbq('track', 'InitiateCheckout', {
        value: $('#paypal_amount').val(),
        currency: 'USD',
    });
});


$('#save_proposal').click(function () {
    $.ajax({
        type: "POST",
        url: "/video/add-proposal-title",
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            video_id: $('#proposal_video').val(),
            title: $('#proposal_title').val(),
            description: $('#proposal_description').val()
        }
    }).done(function (response_json) {
        var response = JSON.parse(response_json);
        if (parseInt(response.status) === 0) {
            addProposalErrorContainer(response.messages);
        } else if (parseInt(response.status) === 1) {
            addProposalSuccessContainer(response.messages);
        } else if (parseInt(response.status) === 2) {
            closeProposalSuccess();
            closeProposalError();
            $('.edit-video__container').toggleClass('edit-video__container--flex');
        }
    });
});


function addProposalErrorContainer(messages) {
    $.each(messages, function (key, value) {
        $('#error_proposal_response').append('<li>' + value + '</li>');
    });

    $('#error_proposal_container').fadeIn();
    setTimeout(function () {
        closeProposalError();
    }, 5000);
}

$('#proposal_title, #proposal_description').on('click keyup', function () {
    closeProposalError();
});

function closeProposalError() {
    $('#error_proposal_container').fadeOut(50);
    $('#error_proposal_response').html('');
}

function closeProposalSuccess() {
    $('#success_proposal_container').fadeOut(50);
    $('#success_proposal_response').html('');
}


function addProposalSuccessContainer(messages) {
    $('.edit-video__container').toggleClass('edit-video__container--flex');
    $.each(messages, function (key, value) {
        $('#success_proposal_response').append('<li>' + value + '</li>');
    });

    $('#success_proposal_container').fadeIn();
    setTimeout(function () {
        closeProposalSuccess();
    }, 3500);
}


$('#add_tags_proposal').click(function () {
    addProposalTag();
});

$("#tag_proposal").on('keyup', function (e) {
    if (e.keyCode === 13) {
        $('#add_tags_proposal').click();
    }
});

function addProposalTag() {
    var input = $('#tag_proposal');
    input.attr('title', '');
    input.attr('data-original-title', '');
    input.tooltip('hide');
    $.ajax({
        type: "POST",
        url: "/video/add-proposal-tag",
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            video_id: $('#proposal_video').val(),
            tag: input.val()
        }
    }).done(function (response_json) {
        var response = JSON.parse(response_json);
        if (parseInt(response.status) === 0) {
            input.attr('title', response.message);
            input.attr('data-original-title', response.message);
            input.tooltip('show');
            setTimeout(function () {
                input.tooltip('hide');
            }, 3000);
        } else{
            $('.add_tags').before('<span class="proposal_tag">'+ input.val() +' <i data-tag-remove="'+ response.id +'" class="fa fa-times-circle pointer" aria-hidden="true"></i></span>');
            input.val('').focus();
        }
    });
}

$(document).on('click', '[data-tag-remove]', function () {
    var tagId = $(this).attr('data-tag-remove');
    $(this).parent().remove();
    $.ajax({
        type: "POST",
        url: "/video/remove-proposal-tag",
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            tagId: tagId
        }
    });
});

$('#buy_now_popup').click(function () {
    $('#buy_now_popup-bg').css('display', 'block');
    $('#buy_now_popup-container').css('display', 'flex');
});

$('#buy_pp').click(function () {
    $('#pay_paypal').click();
});

$('#buy_arc').click(function () {
    $('#buy_arc_btn').click();
});

























