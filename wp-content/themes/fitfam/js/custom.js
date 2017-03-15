function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (m, key, value) {
        vars[key] = value;
    });
    return vars;
}

function check_register()
{
    if ($('[name=reg_name]').val() == "")
    {
        msg = "You can't leave this empty";
        $('#reg_name').after('<div id="error" class="error">' + msg + '</div>');
        setTimeout(function () {
            var parent = document.getElementById("row-reg-name");
            var child = document.getElementById("error");
            parent.removeChild(child);
        }, 3000);

        return false;
    } else if ($('[name=reg_pass]').val() == "")
    {
        msg = "You can't leave this empty";
        $('#reg_pass').after('<div id="error" class="error">' + msg + '</div>');
        setTimeout(function () {
            var parent = document.getElementById("row-reg-pass");
            var child = document.getElementById("error");
            parent.removeChild(child);
        }, 3000);

        return false;
    } else if ($('[name=reg_pass]').val().length < 8)
    {
        msg = "Password must contain at least 8 characters!";
        $('#reg_pass').after('<div id="error" class="error">' + msg + '</div>');
        setTimeout(function () {
            var parent = document.getElementById("row-reg-pass");
            var child = document.getElementById("error");
            parent.removeChild(child);
        }, 3000);

        return false;
    } else if ($('[name=reg_email]').val() == "")
    {
        msg = "You can't leave this empty";
        $('#reg_email').after('<div id="error" class="error">' + msg + '</div>');
        setTimeout(function () {
            var parent = document.getElementById("row-reg-email");
            var child = document.getElementById("error");
            parent.removeChild(child);
        }, 3000);

        return false;
    } else if (!/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/.test($('[name=reg_email]').val()))
    {
        msg = "A valid email address is required";
        $('#reg_email').after('<div id="error" class="error">' + msg + '</div>');
        setTimeout(function () {
            var parent = document.getElementById("row-reg-email");
            var child = document.getElementById("error");
            parent.removeChild(child);
        }, 3000);

        return false;
    } else
        return true;

}

$(function () {

    var login = getUrlVars()["login"];
    if (login == 'failed#' || login == 'failed')
    {
        $('.modal-overlay').fadeIn(200);
        $('.modal-login').fadeIn(200);
    }

    if (window.location.hash == '#_=_') {
        history.replaceState
                ? history.replaceState(null, null, window.location.href.split('#')[0])
                : window.location.hash = '';
    }
    // modal close
    $('.modal-close').on('click', function () {
        $('.modal-overlay').fadeOut(100);
        $('.modal-log').fadeOut(100);
        $('.cart-modal').fadeOut(100);
        $('#home').css('overflow-y', 'auto');
    });

    // Modals
    $('#login-button').on('click', function () {
        $('.modal-overlay').fadeIn(200);
        $('.modal-login').fadeIn(200);
        $('#home').css('overflow', 'hidden');
    });

    $('.modal-overlay').on('click', function (e) {
        if (e.target !== this)
            return;
        else
            $('.modal-close').click();
    });

    $('#signUp-button').on('click', function () {

        $('#form-login').hide();
        $('#form-registration').show();
        $('.tabs').find('.selected').removeClass('selected');
        $(this).addClass('selected');
        $('#home').css('overflow', 'hidden');
    });

    $('#logIn-button').on('click', function () {
        $('#form-login').show();
        $('#form-registration').hide();
        $('.tabs').find('.selected').removeClass('selected');
        $(this).addClass('selected');
    });

    $('#signup-button').on('click', function () {
        $('.modal-overlay').fadeIn(200);
        $('.modal-login').fadeIn(200);
        $('#signUp-button').click();
    });
});

var leftToggle = false;

$(document).ready(function () {
    $('.bars-toggle').click(function () {
        if (leftToggle === false) {
            $(this).animate({
                marginLeft: '160px'
            }, 300);
            $('#myNavbar-left').animate({
                marginLeft: '0px'
            }, 300);
            leftToggle = true;
        } else {
            $(this).animate({
                marginLeft: '0px'
            }, 300);
            $('#myNavbar-left').animate({
                marginLeft: '-160px'
            }, 300);
            leftToggle = false;
        }
    });
});

var Toggle = false;

$(document).ready(function () {
    $('.index-toggle').click(function () {
        if (Toggle === false) {
            $(this).animate({
                marginRight: '160px'
            }, 300);
            $('#myNavbar').animate({
                marginRight: '0px'
            }, 300);
            Toggle = true;
        } else {
            $(this).animate({
                marginRight: '0px'
            }, 300);
            $('#myNavbar').animate({
                marginRight: '-160px'
            }, 300);
            Toggle = false;
        }
    });
});

var ToggleBig = false;

$(document).ready(function () {
    $('#large-dev-side').click(function () {
        if (ToggleBig === false) {
            $('.side-bar').animate({
                marginLeft: '0px'
            }, 300);
            ToggleBig = true;
        } else {
            $('.side-bar').animate({
                marginLeft: '-180px'
            }, 300);
            ToggleBig = false;
        }
    });
});

var bigMargin = 3;
var length = $('.slide').length;

$(document).ready(function () {
    $('.longer').css('width', 100 * length + '%');
    $('.longer').css('margin-left', '-200%');
    $('.slide').css('width', 100 / length + '%');

    setInterval(function () {
        if (bigMargin < length) {
            bigMargin++;
            $('.vid-div').removeClass('active-vid');
            $('.vid-div:nth-child(' + bigMargin + ')').addClass('active-vid');
            $('.longer').animate({
                marginLeft: '-=100%'
            }, 800);
            $('.tags').hide();
            $('.tags:nth-child(' + bigMargin + ')').fadeIn();
        } else if (bigMargin == length) {
            bigMargin = 1;
            $('.vid-div').removeClass('active-vid');
            $('.vid-div:nth-child(' + bigMargin + ')').addClass('active-vid');
            $('.longer').animate({
                marginLeft: '0%'
            }, 800);
        }
    }, 10000);

    $('.tags').hide();
    $('.tags:nth-child(' + bigMargin + ')').fadeIn();

    $('.gray-left').click(function () {
        if (bigMargin < length) {
            bigMargin++;
            $('.longer').animate({
                marginLeft: '-=100%'
            }, 800);
            $('.tags').hide();
            $('.tags:nth-child(' + bigMargin + ')').fadeIn();
        }
    });

    $('.vid-div').click(function () {
        if (bigMargin <= length) {
            var Index = $(this).index();
            bigMargin = Index + 1;
            var Position = (100 * bigMargin) - 100;
            $('.vid-div').removeClass('active-vid');
            $('.vid-div:nth-child(' + bigMargin + ')').addClass('active-vid');
            $('.longer').animate({
                marginLeft: '-' + Position + '%'
            }, 800);
            $('.tags').hide();
            $('.tags:nth-child(' + bigMargin + ')').fadeIn();
        }
    });

    $('.gray-right').click(function () {
        if (bigMargin > 1) {
            bigMargin--;
            $('.longer').animate({
                marginLeft: '+=100%'
            }, 800);
            $('.tags').hide();
            $('.tags:nth-child(' + bigMargin + ')').fadeIn();
        }
    });


});

$('.press-left-bigger').click(function () {
    if (bigMargin < length) {
        bigMargin++;
        $('span.circle').removeClass('active-circle');
        $('span.circle:nth-child(' + bigMargin + ')').addClass('active-circle');
        $('.longer').animate({
            marginLeft: '-=100%'
        }, 500);
    }
});

$('.press-right-bigger').click(function () {
    if (bigMargin > 1) {
        bigMargin--;
        $('span.circle').removeClass('active-circle');
        $('span.circle:nth-child(' + bigMargin + ')').addClass('active-circle');
        $('.longer').animate({
            marginLeft: '+=100%'
        }, 500);
    }
});

$('.vid-div-channels:even').addClass('shaded');

var counter = 3;
var counterLen = $('.tags').length;
$('.tags').hide();
$('.tags:nth-child(' + counter + ')').fadeIn();

$('.gray-right-channels').click(function () {
    if (counter > 1) {
        counter--;
        $('.tags').hide();
        $('.tags:nth-child(' + counter + ')').fadeIn();
    }
});

$('.gray-left-channels').click(function () {
    if (counter < counterLen) {
        counter++;
        $('.tags').hide();
        $('.tags:nth-child(' + counter + ')').fadeIn();
    }
});

$('#video-flip').click(function () {
    $('#video-panel').slideToggle();
    $(this).find('img').toggle();
});
