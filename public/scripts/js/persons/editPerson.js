import { success, error } from "../helpers/sweetAlerts.js";
import { createPerson, getStreets, getHouses } from "../helpers/requests.js";
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

    // --------------------------------------------
    streetsSelect.addEventListener("change", (e) => {
        showHouses(e.target.value);
    });

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
        console.log(houses);
        housesSelect.innerHTML = createHTMLOptions(houses, ["id", "number"]);
        loaderHouse.style.display = "none";
        housesSelect.disabled = false;
    }

    showStreets();

    const btnUploadImage = getId("upload-image");
    const btnFile = getId("perfil-photo");
    const imagePreview = getId("perfil-preview");
    const anchorImagePreview = imagePreview.parentNode;
    const fileReader = new FileReader();
    const form = getId("edit-person-form");
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

    form.addEventListener("submit", (e) => e.preventDefault());
    btnUploadImage.addEventListener("click", () => btnFile.click());

    btnFile.addEventListener("change", (e) => {
        const imgFile = e.target.files[0];
        if (!isImage(btnFile)) {
            setLinkImagePreview("/images/anon.png");
            return;
        }

        fileReader.onload = () => {
            setLinkImagePreview(fileReader.result);
        };
        fileReader.readAsDataURL(imgFile);
    });

    checkEmptyInputsInForm(form, inputNames);

    btnCreatePerson.addEventListener("click", async () => {
        const data = new FormData(form);
        const isValid = isValidForm(form, inputNames);
        if (!isValid) return;

        Swal.fire({
            title: "Creando persona",
            allowEscapeKey: false,
            showConfirmButton: false,
            onBeforeOpen: async () => {
                // execute code before the alert open
                Swal.showLoading();
                try {
                    const res = await createPerson(
                        checkEmptyValueFormData(data)
                    );
                    if (res.message === "ok") {
                        success(
                            "Persona creada",
                            "La Persona " + number + " se creó con exito."
                        );
                        window.location.href = "/personas";
                    } else {
                        error("Ocurrió un error al crear la persona.");
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
