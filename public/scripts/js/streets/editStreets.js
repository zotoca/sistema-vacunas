import { eidtOrExitButtons, success, error } from "../helpers/sweetAlerts.js";
import { editStreet } from "../helpers/requests.js";
import { selectorAll } from "../helpers/DOM.js";

window.addEventListener("DOMContentLoaded", () => {
    const btnsDeleteStreets = selectorAll("button[data-action='edit']");

    btnsDeleteStreets.forEach((btn) =>
        btn.addEventListener("click", () => {
            const id = +btn.getAttribute("data-id");
            editStreetConfirm(id);
        })
    );
});

function editStreetConfirm(id) {
    Swal.fire({
        title: "Editar calle",
        icon: "warning",
        input: "text",
        inputPlaceholder: "Nuevo nombre de la calle",
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
            return editStreet(name, id).then(
                (res) => {
                    if (res.message === "ok") {
                        success("Calle editada", "");
                        window.location.reload();
                    } else {
                        error("Ocurrió un error al editada la calle.");
                    }
                },
                () => error("Ocurrió un error de conexión.")
            );
        },
        ...eidtOrExitButtons,
    });
}
