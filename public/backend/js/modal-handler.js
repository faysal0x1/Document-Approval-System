// public/backend/modal-handler.js
class ModalHandler {
    constructor() {
        this.modalContainer = '#modalContainer';
    }

    /**
     * Load modal content dynamically
     * @param {Object} config - Configuration object
     * @param {string} config.route - Route to fetch modal content
     * @param {string} config.modalName - ID of the modal (without #)
     * @param {Object} config.params - Additional parameters to pass to the server (optional)
     * @param {Function} config.onSuccess - Callback after modal is loaded (optional)
     * @param {Function} config.onError - Error callback (optional)
     * @param {string} config.method - HTTP method (default: 'GET')
     * @param {Object} config.data - Data to send with request (optional)
     */
    load(config) {
        showLoader(); // Assuming you have a global loader function

        const defaultConfig = {
            method: 'GET',
            params: {},
            onSuccess: () => {
            },
            onError: (error) => {
                console.error('modal loading error:', error);
                AjaxNotifications.error('Failed to load modal content');
            }
        };

        config = {...defaultConfig, ...config};

        // Process route parameters if any
        let processedRoute = config.route;
        if (config.params) {
            Object.keys(config.params).forEach(key => {
                processedRoute = processedRoute.replace(`:${key}`, config.params[key]);
            });
        }

        $.ajax({
            url: processedRoute,
            method: config.method,
            data: config.data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (response) => {
                $(this.modalContainer).html(response);
                const modalElement = document.getElementById(config.modalName);
                if (modalElement) {
                    const modal = new bootstrap.Modal(modalElement);
                    modal.show();
                    config.onSuccess(response, modal);
                } else {
                    console.error(`Modal with ID '${config.modalName}' not found in response`);
                }
                hideLoader();
            },
            error: (xhr) => {
                hideLoader();
                config.onError(xhr);
            }
        });
    }

    /**
     * Close a specific modal
     * @param {string} modalName - ID of the modal (without #)
     */
    close(modalName) {
        const modalElement = document.getElementById(modalName);
        if (modalElement) {
            const modal = bootstrap.Modal.getInstance(modalElement);
            if (modal) {
                modal.hide();
            }
        }
    }

    /**
     * Submit form data from within a modal
     * @param {Object} config - Configuration object
     * @param {string} config.formId - ID of the form to submit
     * @param {string} config.route - Submission route
     * @param {string} config.modalName - ID of the modal to close after success
     * @param {Function} config.onSuccess - Success callback (optional)
     * @param {Function} config.onError - Error callback (optional)
     * @param {string} config.method - HTTP method (default: 'POST')
     */
    submitForm(config) {
        const defaultConfig = {
            method: 'POST',
            onSuccess: () => {
            },
            onError: (xhr) => {
                if (xhr.status === 422) {
                    // Validation errors
                    let response = JSON.parse(xhr.responseText);
                    let errorMessages = [];
                    for (let field in response.errors) {
                        errorMessages = errorMessages.concat(response.errors[field]);
                    }
                    AjaxNotifications.error(errorMessages.join('<br>'));
                } else {
                    // Try to parse the error response
                    try {
                        let response = JSON.parse(xhr.responseText);
                        if (response.messages && response.messages.error) {
                            // Display the specific error message
                            AjaxNotifications.error(response.messages.error);
                        } else if (response.error) {
                            // Some APIs use 'error' directly
                            AjaxNotifications.error(response.error);
                        } else {
                            // Fallback to generic error
                            console.error('Form submission error:', xhr);
                            AjaxNotifications.error(xhr);
                        }
                    } catch (e) {
                        // If JSON parsing fails, show generic error
                        console.error('Form submission error:', xhr);
                        AjaxNotifications.error(xhr);
                    }
                }
            }
        };
        config = {...defaultConfig, ...config};

        showLoader();

        const form = document.getElementById(config.formId);
        const formData = new FormData(form);

        // If it's a PUT request, we need to append the _method field
        if (config.method === 'PUT') {
            formData.append('_method', 'PUT');
        }

        // Debug log to check the form data
        console.log('Submitting form data:');
        for (let pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }

        $.ajax({
            url: config.route,
            method: 'POST',  // Always use POST for FormData
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (response) => {
                this.close(config.modalName);
                AjaxNotifications.handle(response);
                config.onSuccess(response);
                hideLoader();

                // If loadTable exists, refresh the data
                if (typeof loadTable === 'function') {
                    loadTable();
                }
            },
            error: (xhr) => {
                config.onError(xhr);
                hideLoader();
            }
        });
    }
}

// Initialize global modal handler
const modalHandler = new ModalHandler();

// Usage examples - you can create a separate file for these common functions
function loadAddModal(route, modalName, params = {}) {
    modalHandler.load({
        route: route,
        modalName: modalName,
        params: params
    });
}

function loadEditModal(route, modalName, params = {}) {
    modalHandler.load({
        route: route,
        modalName: modalName,
        params: params
    });
}

function submitModalForm(formId, route, modalName, method = 'POST') {
    modalHandler.submitForm({
        formId: formId,
        route: route,
        modalName: modalName,
        method: method,
        onSuccess: () => {
            if (typeof loadTable === 'function') {
                loadTable();
            }
        }
    });
}