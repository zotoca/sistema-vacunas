import { createOrExitButtons, success, error } from "../helpers/sweetAlerts.js";
import { createStreet } from "../helpers/requests.js";
import { getId } from "../helpers/DOM.js";

window.addEventListener("DOMContentLoaded", () => {
    const btnCreateStreet = getId("create-street");
    btnCreateStreet.addEventListener("click", async () => {
        Swal.fire({
            title: "Crear una calle",
            input: "text",
            inputPlaceholder: "Nombre de la calle",
            allowEscapeKey: false,
            preConfirm: async (name) => {
                if (!name) {
                    error("El campo debe ser obligatorio.");
                    return;
                }
                try {
                    const res = await createStreet(name);
                    if (res.message === "ok") {
                        success(
                            "Calle creada",
                            "La calle " + name + " se creó con exito."
                        );
                        window.location.reload();
                    } else {
                        error("Ocurrió un error al crear la calle.");
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
