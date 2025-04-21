// resource/js/modal-handler.js
class ModalHandler {
    constructor() {
        this.modalContainer = '#modalContainer';
    }

    /**
     * Load modal content dynamically
     * @param {Object} config - Configuration object
     * @param {Object} config.route - Route configuration { name: string, params: object }
     * @param {string} config.modalName - ID of the modal (without #)
     * @param {Function} config.onSuccess - Callback after modal is loaded (optional)
     * @param {Function} config.onError - Error callback (optional)
     * @param {string} config.method - HTTP method (default: 'GET')
     * @param {Object} config.data - Additional data to send with request (optional)
     */
    load(config) {
        showLoader();

        const defaultConfig = {
            method: 'GET',
            onSuccess: () => {
            },
            onError: (error) => {
                console.error('modal loading error:', error);
                AjaxNotifications.error('Failed to load modal content');
            }
        };

        config = {...defaultConfig, ...config};

        $.ajax({
            url: route(config.route.name, config.route.params || {}),
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
     * Submit form data from within a modal
     * @param {Object} config - Configuration object
     * @param {string} config.formId - ID of the form to submit
     * @param {Object} config.route - Route configuration { name: string, params: object }
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
                    let response = JSON.parse(xhr.responseText);
                    let errorMessages = [];
                    for (let field in response.errors) {
                        errorMessages = errorMessages.concat(response.errors[field]);
                    }
                    AjaxNotifications.error(errorMessages.join('<br>'));
                } else {
                    AjaxNotifications.error('An error occurred while submitting the form');
                }
            }
        };

        config = {...defaultConfig, ...config};
        showLoader();

        $.ajax({
            url: route(config.route.name, config.route.params || {}),
            method: config.method,
            data: $(`#${config.formId}`).serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (response) => {
                const modalElement = document.getElementById(config.modalName);
                if (modalElement) {
                    const modal = bootstrap.Modal.getInstance(modalElement);
                    if (modal) {
                        modal.hide();
                    }
                }
                AjaxNotifications.handle(response);
                config.onSuccess(response);
                hideLoader();
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

// Global helper functions
function loadAddModal(routeName, modalName, params = {}) {
    modalHandler.load({
        route: {
            name: routeName,
            params: params
        },
        modalName: modalName
    });
}

function loadEditModal(routeName, modalName, params = {}) {
    modalHandler.load({
        route: {
            name: routeName,
            params: params
        },
        modalName: modalName
    });
}

function submitModalForm(formId, routeName, modalName, params = {}, method = 'POST') {
    modalHandler.submitForm({
        formId: formId,
        route: {
            name: routeName,
            params: params
        },
        modalName: modalName,
        method: method,
        beforeSubmit: () => {
            console.log(params)
            console.log(routeName);
            console.log(modalName);
            console.log(formId);
            console.log(params);

        },
        onSuccess: () => {
            if (typeof loadTable === 'function') {
                loadTable();
            }
        }
    });
}