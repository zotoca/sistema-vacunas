import { isImage } from "../helpers/checkTypeFile.js";
import { getId } from "../helpers/DOM.js";
import { error } from "../helpers/sweetAlerts.js";
import { configNews } from "../helpers/tinymceConfig.js";

document.addEventListener("DOMContentLoaded", () => {
    const btnUploadFile = getId("image");
    const btnUpload = getId("upload-image");

    btnUpload.addEventListener("click", () => btnUploadFile.click());

    btnUploadFile.addEventListener("change", () => {
        if (!isImage(btnUploadFile)) {
            error("Seleccione un archivo formato imagen");
            btnUploadFile.value = null;
        }
    });

    tinymce.init(configNews);
});
