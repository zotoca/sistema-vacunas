import { createOrExitButtons, success, error } from "../helpers/sweetAlerts.js";
import { createVaccination } from "../helpers/requests.js";

window.addEventListener("DOMContentLoaded", () => {
    const btnCreateVaccination = document.getElementById("create-vaccination");
    btnCreateVaccination.addEventListener("click", async () => {
        Swal.fire({
            title: "Crear una vacuna",
            input: "text",
            inputPlaceholder: "Nombre de la vacuna",
            allowEscapeKey : false,
            preConfirm: async (name) => {
                if (!name) {
                    error("El campo debe ser obligatorio.");
                    return;
                }
                try {
                    const res = await createVaccination(name);
                    if (res.message === "ok") {
                        success(
                            "Vacuna creada",
                            "La vacuna " + name + " se creó con exito."
                        );
                    } else {
                        error("Ocurrió un error al crear la vacuna.");
                    }
                } catch (e) {
                    error("Ocurrió un error de conexión.");
                }
            },
            allowOutsideClick: () => !Swal.isLoading(), // don't exit while loading fetch
            showLoaderOnConfirm: true,
            ...createOrExitButtons,
        });
    });
});
