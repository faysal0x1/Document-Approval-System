//global Ajax Handler

import $ from 'jquery';
import toastr from './toastr';

$(document).ready(function () {
    // Store the original $.ajax function
    const originalAjax = $.ajax;

    // Override the $.ajax function
    $.ajax = function (options) {
        // Create a new 'complete' callback
        options.complete = function (jqXHR, textStatus) {
            // Parse the response
            let response;
            try {
                response = JSON.parse(jqXHR.responseText);
            } catch (e) {
                response = jqXHR.responseText;
            }

            // Handle the response based on the status
            if (jqXHR.status >= 200 && jqXHR.status < 300) {
                // Success
                if (response && response.message) {
                    toastr.success(response.message);
                }
            } else {
                // Error
                if (response && response.message) {
                    toastr.error(response.message);
                } else if (response && response.errors) {
                    // Handle validation errors
                    var errorMessages = [];
                    for (var key in response.errors) {
                        errorMessages = errorMessages.concat(response.errors[key]);
                    }
                    toastr.error(errorMessages.join('<br>'));
                } else {
                    toastr.error('An error occurred');
                }
            }

            // Call the original complete callback if it exists
            if (typeof options.complete === 'function') {
                options.complete(jqXHR, textStatus);
            }
        };

        // Call the original $.ajax with our modified options
        return originalAjax.call(this, options);
    };
});