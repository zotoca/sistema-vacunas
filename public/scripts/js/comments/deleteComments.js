import { deleteOrExitButtons, success, error } from "../helpers/sweetAlerts.js";
import { deleteComment } from "../helpers/requests.js";
import { selectorAll } from "../helpers/DOM.js";

document.addEventListener("DOMContentLoaded", () => {
    const btnsDeleteComments = selectorAll("button[data-action='delete']");

    btnsDeleteComments.forEach((btn) =>
        btn.addEventListener("click", () => {
            const id = +btn.getAttribute("data-id");
            deleteCommentConfirm(id);
        })
    );
});

function deleteCommentConfirm(id) {
    Swal.fire({
        title: "¿Deseas eliminar este comentario?",
        icon: "warning",
        allowEscapeKey: false,
        showLoaderOnConfirm: true,
        allowOutsideClick: false,
        // es necesario retornar una promesa para que se pause el modal
        // hasta no terminar, no es posible salir del modal
        preConfirm: () => {
            // promise returned
            return deleteComment(id).then(
                (res) => {
                    if (res.message === "ok") {
                        success("Comentario eliminado", "");
                        window.location.reload();
                    } else {
                        error("Ocurrió un error al crear el comentario.");
                    }
                },
                () => error("Ocurrió un error de conexión.")
            );
        },
        ...deleteOrExitButtons,
    });
}
