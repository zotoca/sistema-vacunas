import { isImage } from "../helpers/checkTypeFile.js";
import isValidForm, { checkEmptyInputsInForm } from "../helpers/forms.js";
import { getId } from "../helpers/DOM.js";

window.addEventListener("DOMContentLoaded", () => {
    const btnUploadImage = getId("upload-image");
    const btnFile = getId("perfil-photo");
    const imagePreview = getId("perfil-preview");
    const anchorImagePreview = imagePreview.parentNode;
    const fileReader = new FileReader();
    const form = getId("create-person-form");
    const btnCreatePerson = getId("create-person");
    const inputNames = [
        "first_name",
        "last_name",
        "dni",
        "phone_number",
        "gender",
        "birthday",
        "street_id",
        "house_id",
    ];
    const setLinkImagePreview = (img) => {
        imagePreview.src = img;
        anchorImagePreview.href = img;
        anchorImagePreview.setAttribute("data-lightbox", img);
    };

    checkEmptyInputsInForm(form, inputNames);

    btnUploadImage.addEventListener("click", () => btnFile.click());

    btnFile.addEventListener("change", (e) => {
        const imgFile = e.target.files[0];
        if (!isImage(btnFile)) {
            setLinkImagePreview("/images/anon.png");
            return;
        }

        fileReader.onload = () => setLinkImagePreview(fileReader.result);
        fileReader.readAsDataURL(imgFile);
    });

    btnCreatePerson.addEventListener("click", async () => {
        const isValid = isValidForm(form, inputNames);
        if (!isValid) return;
    });
});
