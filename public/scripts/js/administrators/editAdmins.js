import { isImage } from "../helpers/checkTypeFile.js";
import isValidForm, { checkEmptyInputsInForm } from "../helpers/forms.js";
import { getId, setLinkImagePreview } from "../helpers/DOM.js";

document.addEventListener("DOMContentLoaded", () => {
    // --------- MANEJO DE IMAGENES, ARCHIVOS Y FORMULARIO ------------
    const btnUploadImage = getId("upload-image");
    const btnFile = getId("perfil-photo");
    const imagePreview = getId("perfil-preview");
    const anchorImagePreview = imagePreview.parentNode;
    const fileReader = new FileReader();
    const form = getId("edit-admin-form");
    const btnEditAdmin = getId("edit-admin");

    const inputNames = [
        "first_name",
        "last_name",
        "email",
    ];

    checkEmptyInputsInForm(form, inputNames);

    form.addEventListener("submit", (e) => e.preventDefault());
    btnUploadImage.addEventListener("click", () => btnFile.click());
    btnFile.addEventListener("change", (e) => {
        const imgFile = e.target.files[0];
        const args = { anchorImagePreview, imagePreview };
        if (!isImage(btnFile)) {
            setLinkImagePreview({ img: "/images/anon.png", ...args });
            return;
        }

        fileReader.onload = () =>
            setLinkImagePreview({ img: fileReader.result, ...args });
        fileReader.readAsDataURL(imgFile);
    });

    btnEditAdmin.addEventListener("click", async () => {
        const isValid = isValidForm(form, inputNames);
        if (!isValid) return;
        form.submit();
    });
});
