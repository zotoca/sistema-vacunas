import { eidtOrExitButtons, success, error } from "../helpers/sweetAlerts.js";
import { editComment } from "../helpers/requests.js";
import { selectorAll } from "../helpers/DOM.js";

document.addEventListener("DOMContentLoaded", () => {
    const btnsDeleteComments = selectorAll("button[data-action='edit']");

    btnsDeleteComments.forEach((btn) =>
        btn.addEventListener("click", () => {
            const id = +btn.getAttribute("data-id");
            editCommentConfirm(id);
        })
    );
});

function editCommentConfirm(id) {
    Swal.fire({
        title: "Editar comentario",
        icon: "warning",
        input: "text",
        inputPlaceholder: "Nuevo contenido del comentario",
        allowEscapeKey: false,
        showLoaderOnConfirm: true,
        allowOutsideClick: () => !Swal.isLoading(),
        // es necesario retornar una promesa para que se pause el modal
        // hasta no terminar, no es posible salir del modal
        preConfirm: (content) => {
            if (!content) {
                error("El campo debe ser obligatorio.");
                // es necesario retornar una promesa, por lo tanto
                // se simula que hubo una promesa failla
                return Promise.reject("El campo debe ser obligatorio.");
            }
            // promise returned
            return editComment(content, id).then(
                (res) => {
                    if (res.message === "ok") {
                        success("Comentario editado", "");
                        window.location.reload();
                    } else {
                        error("Ocurrió un error al editar el comentario.");
                    }
                },
                () => error("Ocurrió un error de conexión.")
            );
        },
        ...eidtOrExitButtons,
    });
}
