"use strict";

require("lodash");
require("bootstrap");
window.$ = window.jQuery = require('jquery');
require("./plugins/gallery");
window.axios = require('axios');

if (config.token) {
    window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = config.token;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': config.token
        }
    });
}
$(function(){
    $(".picture").gallery({
        el: "picture",
        unit: 1,
        label: "تصویر شاخص"
    });
})

