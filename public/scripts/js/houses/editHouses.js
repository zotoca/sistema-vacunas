import { eidtOrExitButtons, success, error } from "../helpers/sweetAlerts.js";
import { editHouse } from "../helpers/requests.js";
import { selectorAll } from "../helpers/DOM.js";

window.addEventListener("DOMContentLoaded", () => {
    const btnsDeleteHouses = selectorAll("button[data-action='edit']");

    btnsDeleteHouses.forEach((btn) =>
        btn.addEventListener("click", () => {
            const id = +btn.getAttribute("data-id");
            editHouseConfirm(id);
        })
    );
});

function editHouseConfirm(id) {
    Swal.fire({
        title: "Editar casa",
        icon: "warning",
        input: "number",
        inputPlaceholder: "Nuevo numero de la casa",
        allowEscapeKey: false,
        showLoaderOnConfirm: true,
        allowOutsideClick: () => !Swal.isLoading(),
        // es necesario retornar una promesa para que se pause el modal
        // hasta no terminar, no es posible salir del modal
        preConfirm: (number) => {
            if (!number) {
                error("El campo debe ser obligatorio.");
                // es necesario retornar una promesa, por lo tanto
                // se simula que hubo una promesa failla
                return Promise.reject("El campo debe ser obligatorio.");
            }
            // promise returned
            return editHouse(number, id).then(
                (res) => {
                    if (res.message === "ok") {
                        success("Casa editada", "");
                        window.location.reload();
                    } else {
                        error("Ocurrió un error al editar la casa.");
                    }
                },
                () => error("Ocurrió un error de conexión.")
            );
        },
        ...eidtOrExitButtons,
    });
}
