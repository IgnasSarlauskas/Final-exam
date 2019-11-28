'use strict';

const endpoints = {
    get: 'api/participants/get.php',
    create: 'api/participants/create.php',
    update: 'api/participants/update.php',
    delete: 'api/participants/delete.php'
};

/**
 * Executes API request
 * @param {type} url Endpoint URL
 * @param {type} formData instance of FormData
 * @param {type} success Success callback
 * @param {type} fail Fail callback
 * @returns {undefined}
 *  * Executes API request.
 *  fetch() - url adresu kreipiasi į nurodyta endpoint. formData kintamasis savyje saugo POST
 * metodo masyvą (šiuo atveju pasiselektinto lauko (row) id), ir tą POST masyvą nusiunčią į endpointo adresą. endpointe
 *  (pvz. delete.php), jau egzistuoja atsiųstas POST metodas, ir pagal jį vykdome jame aprašytą php kodą. Kai jis įsivykdo,
 *  jame suformuojamas duomenų masyvas, su success arba fail, pagal tai ar pavyko, ar ne. Baigus šitą, fetch() suformuoja
 *  response objektą json formatu, ir TIK TADA vykdo then(). jeigu pavyksta response decodinti iš jasono, vėl vykdo then().
 *  pagal tai, ar objekte buvo succes arba fail, kviečia atitinkamą f-ją, paduodama to objekto data.
 */
function api(url, formData, success, fail) {
    fetch(url, {
        method: 'POST',
        body: formData
    }).then(response => response.json())
            .then(obj => {
                if (obj.status === 'success') {
                    success(obj.data);
                } else {
                    fail(obj.errors);
                }
            })
            .catch(e => {
                console.log(e);
                fail(['Could not connect to API!']);
            });
}

/**
 * Form array
 * Contains all form-related functionality
 * 
 * Object forms
 */
const forms = {
    /**
     * Create Form
     */
    create: {
        init: function () {
            console.log('Initializing create form...');
            if (this.getElement() !== null) {
                this.getElement().addEventListener('submit', this.onSubmitListener);
            }
        },
        getElement: function () {
            return document.getElementById("create-form");
        },
        onSubmitListener: function (e) {
            e.preventDefault();
            let formData = new FormData(e.target);
            api(endpoints.create, formData, forms.create.success, forms.create.fail);
        },
        success: function (data) {
            const element = forms.create.getElement();

            table.row.append(data);
            forms.ui.errors.hide(element);
            forms.ui.clear(element);
            forms.ui.flash.class(element, 'success');
        },
        fail: function (errors) {
            forms.ui.errors.show(forms.create.getElement(), errors);
        }
    },
    
    /**
     * Common/Universal Form UI Functions
     */
    ui: {
        init: function () {
            // Function has to exist
            // since we're calling init() for
            // all elements withing forms object
        },
        /**
         * Fills form fields with data
         * Each data index corelates with input name attribute
         * 
         * @param {Element} form
         * @param {Object} data 
         */
        fill: function (form, data) {
            form.setAttribute('data-id', data.id);

            Object.keys(data).forEach(data_id => {
                if (form[data_id]) {
                    const input = form.querySelector('input[name="' + data_id + '"]');
                    if (input) {
                        input.value = data[data_id];
                    }
                }
            });
        },
        clear: function (form) {
            var fields = form.querySelectorAll('[name]');
            fields.forEach(field => {
                field.value = '';
            });
        },
        flash: {
            class: function (element, class_name) {
                const prev = element.className;

                element.className += class_name;
                setTimeout(function () {
                    element.className = prev;
                }, 1000);
            }
        },
        /**
         * Form-error related functionality
         */
        errors: {
            /**
             * Shows errors in form
             * Each error index correlates with input name attribute
             * 
             * @param {Element} form
             * @param {Object} errors
             */
            show: function (form, errors) {
                this.hide(form);
                Object.keys(errors).forEach(function (error_id) {
                    const field = form.querySelector('input[name="' + error_id + '"]');
                    const span = document.createElement("span");
                    span.className = 'field-error';
                    span.innerHTML = errors[error_id];
                    field.parentNode.append(span);

                    console.log('Form error in field: ' + error_id + ':' + errors[error_id]);
                });
            },
            /**
             * Hides (destroys) all errors in form
             * @param {type} form
             */
            hide: function (form) {
                const errors = form.querySelectorAll('.field-error');
                if (errors) {
                    errors.forEach(node => {
                        node.remove();
                    });
                }
            }
        }
    }
};

/**
 * Table-related functionality
 */
const table = {
    getElement: function () {
        return document.querySelector('.comment-container');
    },
    init: function () {
        this.data.load();

    },
    /**
     * Data-Related functionality
     */
    data: {
        /**
         * Loads data and populates table from API
         * @returns {undefined}
         */
        load: function () {
            api(endpoints.get, null, this.success, this.fail);
        },
        success: function (data) {
            Object.keys(data).forEach(i => {
                table.row.append(data[i]);
            });
        },
        fail: function (errors) {
            console.log(errors);
        }
    },
    /**
     * Operations with rows
     */
    row: {
        /**
         * Builds row element from data
         * 
         * @param {Object} data
         * @returns {Element}
         */
        build: function (data) {
//            const container = document.querySelector('.card .container');
            const row = document.createElement('div');
            row.className += "card";
            row.setAttribute('data-id', data.id);

            let container = document.createElement('div');
            container.className += "container";
            Object.keys(data).forEach(data_id => {

                container.innerHTML = `
                    <p>Vartotojas: ${data.name}</p>
                    <p><i>"${data.comment}"</i></p>
                   <p>"${data.date}"</p>
                    `;
                row.appendChild(container);
            });

            return row;
        },
        /**
         * Appends row to table from data
         * 
         * @param {Object} data
         */
        append: function (data) {
            table.getElement().append(this.build(data));
        }

    }

};

/**
 * Core page functionality
 */
const app = {
    init: function () {
        // Initialize all forms
        Object.keys(forms).forEach(formId => {
            forms[formId].init();
        });

        table.init();
    }
};

// Launch App
app.init();