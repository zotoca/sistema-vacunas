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

import { getId } from "../helpers/DOM.js";

window.addEventListener("DOMContentLoaded", () => {
    // ---------- CALLES Y CASAS -----------------
    const streetsSelect = getId("street-id");
    const loaderStreet = getId("loader-street");
    const housesSelect = getId("house-id");
    const loaderHouse = getId("loader-house");

    // ------------ CEDULAS ------------------------
    const motherDni = getId("mother-dni");
    const fatherDni = getId("father-dni");
    const personsDNI = {
        father_dni: { node: getId("loader-dni-father"), valid: true },
        mother_dni: { node: getId("loader-dni-mother"), valid: true },
    };

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
        loaderStreet.style.display = "block";
        const streets = await getStreets();
        streetsSelect.innerHTML = createHTMLOptions(streets, ["id", "name"]);
        streetsSelect.disabled = false;
        loaderStreet.style.display = "none";
        showHouses(streetsSelect.value);
    }

    async function showHouses(id) {
        housesSelect.disabled = true;
        loaderHouse.style.display = "block";
        const houses = await getHouses(id);
        housesSelect.innerHTML = createHTMLOptions(houses, ["id", "number"]);
        loaderHouse.style.display = "none";
        housesSelect.disabled = false;
    }

    function toggleBtnSubmit(isDisable = false) {
        btnCreatePerson.disabled = isDisable;
    }

    async function checkDni({ target }) {
        let input = personsDNI[target.name];
        if (target.value) {
            toggleBtnSubmit(true);
            input.node.style.display = "block";
            const isValid = await isValidDni(target.value);

            if (!isValid.isValid) {
                target.classList.add("bad");
                input.valid = false;
            } else {
                target.classList.remove("bad");
                input.valid = true;
                toggleBtnSubmit();
            }
            input.node.style.display = "none";
        } else {
            target.classList.remove("bad");
            input.valid = true;
            toggleBtnSubmit();
        }
        console.log("target.name: " + input.valid);
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
                // Swal.showLoading();
                // try {
                //     const res = await editPerson(
                //         ID_PERSON,
                //         checkEmptyValueFormData(data)
                //     );
                //     if (res.message === "ok") {
                //         success(
                //             "Persona creada",
                //             "La Persona " + number + " se creó con exito."
                //         );
                //         window.location.href = "/personas";
                //     } else {
                //         error("Ocurrió un error al crear la persona.");
                //     }
                // } catch (e) {
                //     console.log(e);
                //     error("Ocurrió un error de conexión.");
                // } finally {
                //     Swal.hideLoading();
                // }
            },
            allowOutsideClick: () => !Swal.isLoading(), // don't exit while loading fetch
        });
    });
});
