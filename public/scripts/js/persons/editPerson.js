import { error } from "../helpers/sweetAlerts.js";
import { isImage } from "../helpers/checkTypeFile.js";
import isValidForm, { checkEmptyInputsInForm } from "../helpers/forms.js";
import {
    getId,
    showStreets,
    showHouses,
    setLinkImagePreview,
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

    // -------- CALLE, CASA y ID DE LA PERSONA DESDE EL SERVER ------
    const streetId = getId("person-street-id").value;
    const houseId = getId("person-house-id").value;

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
    const form = getId("edit-person-form");
    const btnCreatePerson = getId("edit-person");

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

    function _showHouses(id) {
        showHouses({
            id,
            loaderHouse,
            housesSelect,
            houseId,
            toggleBtnSubmit,
            houseError,
        });
    }

    function toggleBtnSubmit(isDisable = false) {
        btnCreatePerson.disabled = isDisable;
    }

    showStreets({
        loaderStreet,
        loaderHouse,
        streetsSelect,
        streetId,
        showHouses: _showHouses,
        streetError,
        houseError,
    });

    // ----------- MANEJADORES DE EVENTOS --------------------------------------
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

    checkEmptyInputsInForm(form, inputNames);

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
        // si no hay errores enviar el formulario
        form.submit();
    });
});
