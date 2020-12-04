import { deleteOrExitButtons, success, error } from "../helpers/sweetAlerts.js";
import { deleteVaccination } from "../helpers/requests.js";

window.addEventListener("DOMContentLoaded", () => {
    const btnsDeleteVaccionations = document.querySelectorAll(
        "button[data-action='delete']"
    );

    btnsDeleteVaccionations.forEach((btn) =>
        btn.addEventListener("click", () => {
            const id = +btn.getAttribute("data-id");
            deleteVaccinationConfirm(id);
        })
    );
});

function deleteVaccinationConfirm(id) {
    Swal.fire({
        title: "¿Deseas eliminar esta vacuna?",
        icon: "warning",
        allowEscapeKey: false,
        showLoaderOnConfirm: true,
        allowOutsideClick: false,
        // es necesario retornar una promesa para que se pause el modal
        // hasta no terminar, no es posible salir del modal
        preConfirm: () => {
            // promise returned
            return deleteVaccination(id).then(
                (res) => {
                    if (res.message === "ok") {
                        success("Vacuna eliminada", "");
                    } else {
                        error("Ocurrió un error al crear la vacuna.");
                    }
                },
                () => error("Ocurrió un error de conexión.")
            );
        },
        ...deleteOrExitButtons,
    });
}