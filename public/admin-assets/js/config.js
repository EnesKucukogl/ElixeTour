/**
 * Config
 * -------------------------------------------------------------------------------------
 * ! IMPORTANT: Make sure you clear the browser local storage In order to see the config changes in the template.
 * ! To clear local storage: (https://www.leadshook.com/help/how-to-clear-local-storage-in-google-chrome-browser/).
 */

'use strict';

// JS global variables
let config = {
  colors: {
    primary: '#696cff',
    secondary: '#8592a3',
    success: '#71dd37',
    info: '#03c3ec',
    warning: '#ffab00',
    danger: '#ff3e1d',
    dark: '#233446',
    black: '#000',
    white: '#fff',
    body: '#f4f5fb',
    headingColor: '#566a7f',
    axisColor: '#a1acb8',
    borderColor: '#eceef1'
  }
};

const msg = (msg, type = "info") => {
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    toastr[type](msg);
}
var editorOptions = [
    'undo', 'redo', 'separator',
    {
        name: 'header',
        acceptedValues: [false, 1, 2, 3, 4, 5],
    }, 'separator',
    'bold', 'italic', 'strike', 'underline', 'separator',
    'alignLeft', 'alignCenter', 'alignRight', 'alignJustify', 'separator',
    {
        widget: 'dxButton',
        options: {
            text: 'Show markup',
            stylingMode: 'text',
            onClick() {
                popupInstance.show();
            },
        },
    },];


const default_symbol = "en"
