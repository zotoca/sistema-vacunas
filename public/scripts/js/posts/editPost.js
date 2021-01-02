import { isImage } from "../helpers/checkTypeFile.js";
import { getId } from "../helpers/DOM.js";

document.addEventListener("DOMContentLoaded", () => {

    const btnUploadFile = getId("image");
    btnUploadFile.addEventListener("change", () => {
        if (!isImage(btnUploadFile)) {
            error("Seleccione un archivo formato imagen");
            btnUploadFile.value = null;
        }
    });

    tinymce.init({
        selector: "#content",
        plugins: "image code",
        toolbar: "image code",
        relative_urls: false,
        convert_urls: true,
        remove_script_host: false,
        images_upload_url: "/foro/subir-imagen",
        height: "480px",
    });
});
