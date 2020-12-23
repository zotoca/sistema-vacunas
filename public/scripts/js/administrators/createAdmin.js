import { isImage } from "../helpers/checkTypeFile.js";
import isValidForm, { checkEmptyInputsInForm } from "../helpers/forms.js";
import { getId, setLinkImagePreview } from "../helpers/DOM.js";

window.addEventListener("DOMContentLoaded", () => {
    // --------- MANEJO DE IMAGENES, ARCHIVOS Y FORMULARIO ------------
    const btnUploadImage = getId("upload-image");
    const btnFile = getId("perfil-photo");
    const imagePreview = getId("perfil-preview");
    const anchorImagePreview = imagePreview.parentNode;
    const fileReader = new FileReader();
    const form = getId("create-admin-form");
    const btnCreateAdmin = getId("create-admin");

    const inputNames = [
        "first_name",
        "last_name",
        "email",
        "password",
        "repeatPassword",
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

    btnCreateAdmin.addEventListener("click", async () => {
        const isValid = isValidForm(form, inputNames);
        if (!isValid) return;
        form.submit();
    });
});
