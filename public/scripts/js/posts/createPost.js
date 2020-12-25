import { error } from "../helpers/sweetAlerts.js";
import { isImage } from "../helpers/checkTypeFile.js";
import isValidForm, { checkEmptyInputsInForm } from "../helpers/forms.js";
import {
    getId,
    setLinkImagePreview,
    showStreets,
    showHouses,
    checkDni,
} from "../helpers/DOM.js";


document.addEventListener("DOMContentLoaded", () => {
    tinymce.init({
        selector:'#content',
        plugins: 'image code',
        toolbar: 'image code',
        images_upload_url: '/foro/subir-imagen',
        height:"480px"
    });


    
});
