import { success, error } from "../helpers/sweetAlerts.js";
import { createPerson } from "../helpers/requests.js";
import isValidForm, { isEmptyInputsForm } from "../helpers/forms.js";
import { getId } from "../helpers/DOM.js";

window.addEventListener("DOMContentLoaded", () => {
    const btnUploadImage = getId("upload-image");
    const btnFile = getId("perfil-photo");
    const imagePreview = getId("perfil-preview");
    const anchorImagePreview = imagePreview.parentNode;

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
        "father_dni",
        "mother_dni",
    ];
    const fileReader = new FileReader();

    form.addEventListener("submit", (e) => e.preventDefault());
    btnUploadImage.addEventListener("click", () => btnFile.click());

    btnFile.addEventListener("change", (e) => {
        const imgFile = e.target.files[0];
        fileReader.onload = () => {
            imagePreview.src = fileReader.result;
            anchorImagePreview.href = fileReader.result;
            anchorImagePreview.setAttribute("data-lightbox", fileReader.result);
        };
        fileReader.readAsDataURL(imgFile);
    });

    isEmptyInputsForm(form, inputNames);

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
                    const res = await createPerson(data);
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
