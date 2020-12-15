import { isImage } from "../helpers/checkTypeFile.js";
import isValidForm, { checkEmptyInputsInForm } from "../helpers/forms.js";
import { getId, setLinkImagePreview, showStreets } from "../helpers/DOM.js";

window.addEventListener("DOMContentLoaded", () => {
    // ---------- CALLES Y CASAS (inputs y loaders) -----------------
    const streetsSelect = getId("street-id");
    const loaderStreet = getId("loader-street");
    const housesSelect = getId("house-id");
    const loaderHouse = getId("loader-house");

    // ------- ICONOS PARA ERRORES DE RED -----------------------------
    const streetError = getId("street-error");
    const houseError = getId("house-error");

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

    showStreets({
        loaderStreet,
        loaderHouse,
        streetsSelect,
        streetId : 0,
        showHouses : () => {}, 
        streetError,
        houseError,
    });

    checkEmptyInputsInForm(form, inputNames);
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

    btnCreatePerson.addEventListener("click", async () => {
        const isValid = isValidForm(form, inputNames);
        if (!isValid) return;
    });
});
