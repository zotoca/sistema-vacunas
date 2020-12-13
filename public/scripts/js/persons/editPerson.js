import { success, error } from "../helpers/sweetAlerts.js";
import {
    editPerson,
    getStreets,
    getHouses,
    isValidDni,
} from "../helpers/requests.js";

import { isImage } from "../helpers/checkTypeFile.js";
import { createHTMLOptions } from "../helpers/DOM.js";

import isValidForm, {
    checkEmptyInputsInForm,
    checkEmptyValueFormData,
} from "../helpers/forms.js";

import {
    getId,
    display,
    addClass,
    removeClass,
    setValueInSelect,
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
    const personId = getId("person-id").value;

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
    const setLinkImagePreview = (img) => {
        imagePreview.src = img;
        anchorImagePreview.href = img;
        anchorImagePreview.setAttribute("data-lightbox", img);
    };

    async function showStreets() {
        display(loaderStreet);
        streetsSelect.disabled = true;
        const streets = await getStreets();
        streetsSelect.innerHTML = createHTMLOptions(streets, ["id", "name"]);
        streetsSelect.disabled = false;
        display(loaderStreet, "none");
        setValueInSelect(streetsSelect, streetId);
        showHouses(streetsSelect.value);
    }

    async function showHouses(id) {
        display(loaderHouse);
        housesSelect.disabled = true;
        const houses = await getHouses(id);
        housesSelect.innerHTML = createHTMLOptions(houses, ["id", "number"]);
        housesSelect.disabled = false;
        display(loaderHouse, "none");
        setValueInSelect(housesSelect, houseId);
    }

    function toggleBtnSubmit(isDisable = false) {
        btnCreatePerson.disabled = isDisable;
    }

    async function checkDni({ target }) {
        let input = personsDNI[target.name];
        if (target.value) {
            display(input.node);
            toggleBtnSubmit(true);
            const isValid = await isValidDni(target.value);

            if (!isValid.isValid) {
                addClass(target, "bad");
                input.valid = false;
            } else {
                removeClass(target, "bad");
                input.valid = true;
            }
            display(input.node, "none");
        } else {
            removeClass(target, "bad");
            input.valid = true;
        }

        toggleBtnSubmit();

        if (!personsDNI.father_dni.valid || !personsDNI.mother_dni.valid) {
            toggleBtnSubmit(true);
        }
    }

    showStreets();

    streetsSelect.addEventListener("change", (e) => showHouses(e.target.value));
    motherDni.addEventListener("blur", checkDni);
    fatherDni.addEventListener("blur", checkDni);
    form.addEventListener("submit", (e) => e.preventDefault());
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

    checkEmptyInputsInForm(form, inputNames);

    btnCreatePerson.addEventListener("click", async () => {
        const data = new FormData(form);
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

        Swal.fire({
            title: "Creando persona",
            allowEscapeKey: false,
            showConfirmButton: false,
            onBeforeOpen: async () => {
                // execute code before the alert open
                Swal.showLoading();
                try {
                    const res = await editPerson(
                        personId,
                        checkEmptyValueFormData(data)
                    );
                    if (res.message === "ok") {
                        success(
                            "Persona editada",
                            "La Persona " + personId + " se editó con exito."
                        );
                        window.location.href = "/personas";
                    } else {
                        error("Ocurrió un error al editar la persona.");
                    }
                } catch (e) {
                    console.log(e);
                    error("Ocurrió un error de conexión.");
                } finally {
                    Swal.hideLoading();
                }
            },
            allowOutsideClick: () => !Swal.isLoading(), // don't exit while loading fetch
        });
    });
});
