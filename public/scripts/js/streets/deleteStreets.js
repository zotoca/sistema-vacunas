import { deleteOrExitButtons, success, error } from "../helpers/sweetAlerts.js";
import { deleteStreet } from "../helpers/requests.js";
import { selectorAll } from "../helpers/DOM.js";

document.addEventListener("DOMContentLoaded", () => {
    const btnsDeleteStreets = selectorAll("button[data-action='delete']");

    btnsDeleteStreets.forEach((btn) =>
        btn.addEventListener("click", () => {
            const id = +btn.getAttribute("data-id");
            deleteStreetConfirm(id);
        })
    );
});

function deleteStreetConfirm(id) {
    Swal.fire({
        title: "¿Deseas eliminar esta calle?",
        icon: "warning",
        allowEscapeKey: false,
        showLoaderOnConfirm: true,
        allowOutsideClick: false,
        // es necesario retornar una promesa para que se pause el modal
        // hasta no terminar, no es posible salir del modal
        preConfirm: () => {
            // promise returned
            return deleteStreet(id).then(
                (res) => {
                    if (res.message === "ok") {
                        success("Calle eliminada", "");
                        window.location.reload();
                    } else {
                        error("Ocurrió un error al crear la calle.");
                    }
                },
                () => error("Ocurrió un error de conexión.")
            );
        },
        ...deleteOrExitButtons,
    });
}
