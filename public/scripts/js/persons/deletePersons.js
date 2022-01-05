import { deleteOrExitButtons, success, error } from "../helpers/sweetAlerts.js";
import { deletePerson } from "../helpers/requests.js";
import { selectorAll } from "../helpers/DOM.js";

document.addEventListener("DOMContentLoaded", () => {
    const btnsdeletePersons = selectorAll("a[data-action='delete']");

    btnsdeletePersons.forEach((btn) =>
        btn.addEventListener("click", () => {
            const id = +btn.getAttribute("data-id");
            deletePersonConfirm(id);
        })
    );
});

function deletePersonConfirm(id) {
    let isLoading = false;
    
    Swal.fire({
        title: "¿Deseas eliminar esta persona?",
        icon: "warning",
        allowEscapeKey: false,
        showLoaderOnConfirm: true,
        allowOutsideClick: () => !isLoading,
        input: "password",
        inputLabel: "Escriba la contraseña para confirmar",
        inputValidator: async (value) => {
            if (!value) {
                return "El campo debe ser obligatorio";
            }
            isLoading = true;
            Swal.showLoading();
            await deletePerson(id, value).then(
                (res) => {
                    if (res.message === "ok") {
                        success("Persona eliminada", "");
                        window.location.reload();
                    } else {
                        error("Ocurrió un error al eliminar la persona.");
                    }
                },
                (err) => {
                    if (err?.response?.data?.errors?.password) {
                        error(
                            "Contraseña incorrecta, verifique y intente de nuevo."
                        );
                        return;
                    }
                    error("Ocurrió un error de conexión.");
                }
            );
            Swal.hideLoading();
            isLoading = false;
        },
        ...deleteOrExitButtons,
    });
}
