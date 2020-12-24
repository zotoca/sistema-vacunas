import { deleteOrExitButtons, success, error } from "../helpers/sweetAlerts.js";
import { deleteHouse } from "../helpers/requests.js";
import { selectorAll } from "../helpers/DOM.js";

document.addEventListener("DOMContentLoaded", () => {
    const btnsDeleteHouses = selectorAll("button[data-action='delete']");

    btnsDeleteHouses.forEach((btn) =>
        btn.addEventListener("click", () => {
            const id = +btn.getAttribute("data-id");
            deleteHouseConfirm(id);
        })
    );
});

function deleteHouseConfirm(id) {
    Swal.fire({
        title: "¿Deseas eliminar esta casa?",
        icon: "warning",
        allowEscapeKey: false,
        showLoaderOnConfirm: true,
        allowOutsideClick: false,
        // es necesario retornar una promesa para que se pause el modal
        // hasta no terminar, no es posible salir del modal
        preConfirm: () => {
            // promise returned
            
            return deleteHouse(id).then(
                (res) => {
                    if (res.message === "ok") {
                        success("Casa eliminada", "");
                        window.location.reload();
                    } else {
                        error("Ocurrió un error al crear la casa.");
                    }
                },
                () => error("Ocurrió un error de conexión.")
            );
        },
        ...deleteOrExitButtons,
    });
}
