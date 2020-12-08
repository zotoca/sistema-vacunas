import { success, error } from "../helpers/sweetAlerts.js";
import { createPerson } from "../helpers/requests.js";
import { getId } from "../helpers/DOM.js";

window.addEventListener("DOMContentLoaded", () => {
    const form = getId("create-person-form");
    form.addEventListener("submit", (e) => e.preventDefault());
    
    const btnCreatePerson = getId("create-person");
    btnCreatePerson.addEventListener("click", async () => {
        const data = new FormData(form);
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
                    Swal.showLoading();
                }
            },
            allowOutsideClick: () => !Swal.isLoading(), // don't exit while loading fetch
        });
    });
});
