define(['jquery'], function ($) {
    'use strict';

    return function (data, element) {
        // fetch response from given api url
        $.getJSON(data.base_url + 'rest/V1/testimonials/2', function (result) {
            console.log(result);
            element.innerText = JSON.stringify(result, null, 2);

        });
    }

});