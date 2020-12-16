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

window.addEventListener("DOMContentLoaded", () => {
    // ---------- CALLES Y CASAS (inputs y loaders) -----------------
    const streetsSelect = getId("street-id");
    const loaderStreet = getId("loader-street");
    const housesSelect = getId("house-id");
    const loaderHouse = getId("loader-house");

    // ------------ CEDULAS ------------------------
    const motherDni = getId("mother-dni");
    const fatherDni = getId("father-dni");
    // las cedulas son validas porq estan vacias
    const personsDNI = {
        father_dni: { node: getId("loader-dni-father"), valid: true },
        mother_dni: { node: getId("loader-dni-mother"), valid: true },
    };

    // ------- ICONOS PARA ERRORES DE RED -----------------------------
    const streetError = getId("street-error");
    const houseError = getId("house-error");
    const dniError = {
        father_dni: getId("dni-father-error"),
        mother_dni: getId("dni-mother-error"),
    };

    // --------- MANEJO DE IMAGENES, ARCHIVOS Y FORMULARIO ------------
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

    function toggleBtnSubmit(isDisable = false) {
        btnCreatePerson.disabled = isDisable;
    }

    function _showHouses(id) {
        showHouses({
            id,
            loaderHouse,
            housesSelect,
            houseId: 0,
            toggleBtnSubmit,
            houseError,
        });
    }

    showStreets({
        loaderStreet,
        loaderHouse,
        streetsSelect,
        streetId: 0,
        showHouses: _showHouses,
        streetError,
        houseError,
    });

    checkEmptyInputsInForm(form, inputNames);
    streetsSelect.addEventListener("change", (e) =>
        _showHouses(e.target.value)
    );

    motherDni.addEventListener("blur", (e) =>
        checkDni({ target: e.target, personsDNI, toggleBtnSubmit, dniError })
    );
    fatherDni.addEventListener("blur", (e) =>
        checkDni({ target: e.target, personsDNI, toggleBtnSubmit, dniError })
    );

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

    btnCreatePerson.addEventListener("click", async () => {
        const isValid = isValidForm(form, inputNames);
        const invalidDNI =
            !personsDNI.mother_dni.valid || !personsDNI.father_dni.valid;

        if (!isValid) return;
        if (invalidDNI) {
            error(
                "Cédula incorrecta, verifique las cédulas de identidad solicitdas."
            );
            toggleBtnSubmit(true);
            return;
        }
        form.submit();
    });
});
