import { eidtOrExitButtons, success, error } from "../helpers/sweetAlerts.js";
import { editVaccination } from "../helpers/requests.js";
import { selectorAll } from "../helpers/DOM.js";

document.addEventListener("DOMContentLoaded", () => {
    const btnsDeleteVaccionations = selectorAll("button[data-action='edit']");

    btnsDeleteVaccionations.forEach((btn) =>
        btn.addEventListener("click", () => {
            const id = +btn.getAttribute("data-id");
            editVaccinationConfirm(id);
        })
    );
});

function editVaccinationConfirm(id) {
    Swal.fire({
        title: "Editar vacuna",
        icon: "warning",
        input: "text",
        inputPlaceholder: "Nuevo nombre de la vacuna",
        allowEscapeKey: false,
        showLoaderOnConfirm: true,
        allowOutsideClick: () => !Swal.isLoading(),
        // es necesario retornar una promesa para que se pause el modal
        // hasta no terminar, no es posible salir del modal
        preConfirm: (name) => {
            if (!name) {
                error("El campo debe ser obligatorio.");
                // es necesario retornar una promesa, por lo tanto
                // se simula que hubo una promesa failla
                return Promise.reject("El campo debe ser obligatorio.");
            }
            // promise returned
            return editVaccination(name, id).then(
                (res) => {
                    if (res.message === "ok") {
                        success("Vacuna editada", "");
                        window.location.reload();
                    } else {
                        error("Ocurrió un error al editar la vacuna.");
                    }
                },
                () => error("Ocurrió un error de conexión.")
            );
        },
        ...eidtOrExitButtons,
    });
}
