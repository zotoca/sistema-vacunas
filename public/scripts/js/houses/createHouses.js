import { createOrExitButtons, success, error } from "../helpers/sweetAlerts.js";
import { createHouse } from "../helpers/requests.js";
import { getId } from "../helpers/DOM.js";

window.addEventListener("DOMContentLoaded", () => {
    const btnCreateHouse = getId("create-house");
    btnCreateHouse.addEventListener("click", async () => {
        Swal.fire({
            title: "Crear una casa",
            input: "number",
            inputPlaceholder: "Numero de la casa",
            allowEscapeKey: false,
            preConfirm: async (number) => {
                if (!number) {
                    error("El campo debe ser obligatorio.");
                    return;
                }
                try {
                    
                    let streetId = document.querySelector("div[data-street-id]").dataset.streetId;
                    
                    const res = await createHouse(number,streetId);
                    if (res.message === "ok") {
                        success(
                            "Casa creada",
                            "La casa " + number + " se creó con exito."
                        );
                        window.location.reload();
                    } else {
                        error("Ocurrió un error al crear la casa.");
                    }
                } catch (e) {
                    console.log(e);
                    error("Ocurrió un error de conexión.");
                }
            },
            allowOutsideClick: () => !Swal.isLoading(), // don't exit while loading fetch
            showLoaderOnConfirm: true,
            ...createOrExitButtons,
        });
    });
});
