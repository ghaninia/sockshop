"use strict";

require("lodash");
require("bootstrap");
window.$ = window.jQuery = require('jquery');
require("./plugins/gallery");
require("./plugins/additive");

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
    positionClass: "toast-top-left",
    rtl: true,
    onHidden: null
};

function jsonFormat(text) {
    return /^[\],:{}\s]*$/.test(text.replace(/\\["\\\/bfnrtu]/g, '@').
        replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').
        replace(/(?:^|:|,)(?:\s*\[)+/g, ''));
}

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

function getAjaxController(data = {}, success, failed = null) {
    Nprogress.start();
    axios.post(config.response, {
        ...data
    }).then(function (response) {
        const { data } = response;
        Nprogress.done();
        return success(data);
    }).catch(function (errors) {
        Nprogress.done();
        return failed ? failed(errors) : null;
    });
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

function GetFormResponse(action, formData = null, success, failed = null) {
    Nprogress.start();
    axios.get(action, formData).then(function (response) {
        const { data } = response;
        Nprogress.done();
        return success(data);
    }).catch(function (errors) {
        Nprogress.done();
        return failed ? failed(errors) : null;
    });
}

function DeleteFromResponse(action, success, failed = null) {
    Nprogress.start();
    axios.delete(action, {
        _method: "DELETE",
        headers: { 'Content-Type': 'multipart/form-data' }
    }).then(function (response) {
        const { data } = response;
        Nprogress.done();
        return success(data);
    }).catch(function (errors) {
        Nprogress.done();
        return failed ? failed(errors) : null;
    });
}

$(document).on("submit", "form", function (e) {
    var F = e.target;
    if (!F.checkValidity()) {
        e.preventDefault();
        e.stopPropagation();
        F.classList.add("was-validated");
    }
});




// forms submit
$(function () {
    var elements = [
        "#form",
        ".form"
    ];
    $(document).on("submit", elements.join(","), function (e) {
        e.preventDefault();
        var form = $(this);
        submit($(this), function (response) {
            document.location.reload();
        }, function (errors) {
            if ($(".captcha", form).length) {
                $(".captcha img", form).click();
            }
        });
    });
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
            <span class="spinner-border spinner-border-sm ml-2"></span>در حال بارگیری ...
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


//recaptcha | کدکپچا
$(function () {
    $(".form-group.captcha img").click(function () {
        var wrapper = $(this).closest(".form-group");
        $('input[name="captcha"]', wrapper).val("");
        var src = $(this).attr("src").split("?")[0];
        $(this).attr("src", src + '?' + Math.floor(Math.random() * 100));
    });
});

//logout | خروج از حساب
$(function () {
    $(".__logout").click(function (e) {
        e.preventDefault();
        var action = $(this).attr("href");
        var conf = confirm("آیا میخواهید از پلن کاربری خارج شوید ؟");
        if (conf) {
            PostFormResponse(action, null, function (items) {
                __sucessMessage(items, function (response) {
                    window.location.reload();
                });
            }, function (errors) {
                __errorMessage(errors, function () {
                });
            });
        }
    });
});

$(function () {
    $(".picture").gallery({
        el: "picture",
        unit: 1,
        label: "تصویر شاخص"
    });
    $(".gallery").gallery({
        el: "galleries",
        label: "گالری محصول"
    });
    $(".logo").gallery({
        el: "logo",
        unit: 1,
        label: "لوگو وبسایت"
    }) ;
    $(".favicon").gallery({
        el: "favicon",
        unit: 1,
        label: "فاوآیکون وبسایت"
    }) ;
    $(".keywords").each(function () {
        $(this).additive({
            element: "keywords",
            inputPlaceHolder: "کلمات کلیدی"
        });
    });
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
})

$(function () {
    $(".tasks .list .item").each(function () {
        $(".remove", this).click(function (e) {
            e.preventDefault();
            var action = $(this).attr("href"),
                wrapper = $(this).closest(".item"),
                conf = confirm("آیا از حذف این آیتم مطمئن هستید ؟");
            if (conf) {
                DeleteFromResponse(action, function (response) {
                    __sucessMessage(response, function () {
                        wrapper.remove();
                        window.location.reload();
                    });
                })
            }
        });
    });

    $("select").each(function () {
        $(this).selectric();
    });

    $(".prices").each(function () {
        var wrapper = $(this),
            name = "variances",
            oldestItems = wrapper.data("oldest") ,
            templates = {
                li: `
                    <li>
                        <div class="remove">
                            <i class="feather-x"></i>
                        </div>
                        <input required name=":name[:id][title]" value=":title" placeholder="تیتر" />
                        <input name=":name[:id][tooltip]" value=":tooltip" placeholder="توضیحات" />
                        <input required type="number" name=":name[:id][price]" value=":price" placeholder="قیمت (ریال)" />
                    </li>
                ` ,
                appendBtn: `
                    <button type="button" class="append border">
                        <i class="feather-plus"></i>
                    </button>
                `
            },
            makeID = (length = 10) => {
                var result = '';
                var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                var charactersLength = characters.length;
                for (var i = 0; i < length; i++) {
                    result += characters.charAt(Math.floor(Math.random() * charactersLength));
                }
                return result;
            },
            liGenerate = (item = {}) => {
                var v_id = item.id || makeID(),
                    v_title = item.title || "",
                    v_tooltip = item.tooltip || "",
                    v_price = item.price || "",
                    temp = templates.li;

                temp = temp.replaceAll(":name", name);
                temp = temp.replaceAll(":id", v_id);
                temp = temp.replaceAll(":title", v_title);
                temp = temp.replaceAll(":tooltip", v_tooltip);
                temp = temp.replaceAll(":price", v_price);
                wrapper.append(temp);
            };

        wrapper.html(templates.appendBtn);
        if( oldestItems && oldestItems.length ){
            oldestItems.map(function(item){
                liGenerate(item) ;
            });
        }


        wrapper.on("click", ".append", function () {
            liGenerate();
        });

        wrapper.on("click", "li .remove", function () {
            var li = $(this).closest("li");
            li.remove();
        });
    });
});
