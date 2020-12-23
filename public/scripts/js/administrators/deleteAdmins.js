import { deleteOrExitButtons, success, error } from "../helpers/sweetAlerts.js";
import { deleteAdmin } from "../helpers/requests.js";
import { selectorAll } from "../helpers/DOM.js";

window.addEventListener("DOMContentLoaded", () => {
    const btnsdeletePersons = selectorAll("a[data-action='delete']");

    btnsdeletePersons.forEach((btn) =>
        btn.addEventListener("click", () => {
            const id = +btn.getAttribute("data-id");
            deletePersonConfirm(id);
        })
    );
});

function deletePersonConfirm(id) {
    Swal.fire({
        title: "¿Deseas eliminar este administrador?",
        icon: "warning",
        allowEscapeKey: false,
        showLoaderOnConfirm: true,
        allowOutsideClick: false,
        // es necesario retornar una promesa para que se pause el modal
        // hasta no terminar, no es posible salir del modal
        preConfirm: () => {
            // promise returned

            return deleteAdmin(id).then(
                (res) => {
                    if (res.message === "ok") {
                        success("Administrador eliminada", "");
                        window.location.reload();
                    } else {
                        error("Ocurrió un error al eliminar el administrador.");
                    }
                },
                () => error("Ocurrió un error de conexión.")
            );
        },
        ...deleteOrExitButtons,
    });
}
