"use strict";
require("lodash");
require("bootstrap");
window.$ = window.jQuery = require('jquery');
window.axios = require('axios');
const Nprogress = require("nprogress");
const toastr = require("toastr");
const selectric = require("selectric");


if (config.token) {
    window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = config.token;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': config.token
        }
    });
}

toastr.options = {
    timeOut: 1000,
    progressBar: true,
    showMethod: "fadeIn",
    hideMethod: "fadeOut",
    showDuration: 200,
    hideDuration: 200,
    positionClass: "toast-bottom-left",
    rtl: true,
    onHidden: null
};

function stepMessage(errors, length, step = 0, callback = null) {
    // if( step == length ){
    // callback(errors) ;
    // }
    if (length > step) {
        var KEY = Object.keys(errors)[step];
        var ERR = errors[KEY][0];
        toastr.error(ERR, null, {
            onHidden: function () {
                stepMessage(errors, length, step + 1);
                if (callback != null) {
                    callback(errors);
                }

            }
        });
    }
}

function __sucessMessage(response, callback) {
    const { ok, msg } = response;
    if (ok && msg.length) {
        return toastr.success(msg, null, {
            onHidden: function () {
                callback(response);
            }
        });
    } else {
        return callback(response);
    }
}

function __errorMessage(err, callback = null) {
    const { ok, msg } = err.response.data;
    if (msg && ok == false) {
        toastr.error(msg, null, {
            onHidden: function () {
                callback != null ? callback(msg) : null;
            }
        });
    } else {
        const { errors, message } = err.response.data
        if (errors != undefined) {
            stepMessage(errors, Object.keys(errors).length, 0, callback);
        } else {
            toastr.error(message, null, {
                onHidden: function () {
                    callback != null ? callback(message) : null;
                }
            });
        }
    }
}

function PostFormResponse(action, formData = null, success, failed = null) {
    Nprogress.start();
    axios.post(action, formData).then(function (response) {
        const { data } = response;
        Nprogress.done();
        return success(data);
    }).catch(function (errors) {
        Nprogress.done();
        return failed ? failed(errors) : null;
    });
}

$(function () {
    $(".host-banner-area .banner-shape").each(function () {
        for (var i = 0; i < 7; i++) {
            $(this).append('<div></div>');
        }
    });
})

$(document).on("submit", "form", function (e) {
    var F = e.target;
    if (!F.checkValidity()) {
        e.preventDefault();
        e.stopPropagation();
        F.classList.add("was-validated");
    }
});

function submit(form, callbackSuccess, callbackERROR = null) {
    var button = $("button[type!=button]", form),
        textButton = button.text(),
        action = form.attr("action"),
        formData = new FormData(form[0]);

    function buttonReturnStyle() {
        return button.html(textButton).attr("disabled", false);
    }

    if ((form[0]).checkValidity()) {
        button.html(`
            <span class="spinner-border spinner-border-sm ml-2"></span>بارگزاری ...
        `).attr("disabled", true);
        PostFormResponse(action, formData, function (items) {
            __sucessMessage(items, function (response) {
                buttonReturnStyle();
                callbackSuccess(response);
            });
        }, function (errors) {
            __errorMessage(errors, function () {
                buttonReturnStyle();
                if (callbackERROR != null) {
                    callbackERROR(errors);
                }
            });
        });
    }
}

// forms submit
$(function () {
    $("#search").submit( function (e) {
        e.preventDefault();
        var form = $(this);
        submit( form , function (response) {

        }, function (errors) {
        });
    });
});
