import { deleteOrExitButtons, success, error } from "../helpers/sweetAlerts.js";
import { deleteNews } from "../helpers/requests.js";
import { selectorAll } from "../helpers/DOM.js";

document.addEventListener("DOMContentLoaded", () => {
    const btnsdeletePosts = selectorAll("a[data-action='delete']");

    btnsdeletePosts.forEach((btn) =>
        btn.addEventListener("click", () => {
            const id = +btn.getAttribute("data-id");
            deleteNewsConfirm(id);
        })
    );
});

function deleteNewsConfirm(id) {
    Swal.fire({
        title: "¿Deseas eliminar esta noticia?",
        icon: "warning",
        allowEscapeKey: false,
        showLoaderOnConfirm: true,
        allowOutsideClick: false,
        // es necesario retornar una promesa para que se pause el modal
        // hasta no terminar, no es posible salir del modal
        preConfirm: () => {
            // promise returned

            return deleteNews(id).then(
                (res) => {
                    if (res.message === "ok") {
                        success("Noticia eliminada", "");
                        window.location.reload();
                    } else {
                        error("Ocurrió un error al eliminar la noticia.");
                    }
                },
                () => error("Ocurrió un error de conexión.")
            );
        },
        ...deleteOrExitButtons,
    });
}
