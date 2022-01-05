import { deleteOrExitButtons, success, error } from "../helpers/sweetAlerts.js";
import { deletePersonVaccination } from "../helpers/requests.js";
import { selectorAll } from "../helpers/DOM.js";

document.addEventListener("DOMContentLoaded", () => {
    const btnsDeletePersonVaccinations = selectorAll(
        "button[data-action='delete']"
    );

    btnsDeletePersonVaccinations.forEach((btn) =>
        btn.addEventListener("click", () => {
            const id = +btn.getAttribute("data-id");
            deletePersonVaccinationConfirm(id);
        })
    );
});

function deletePersonVaccinationConfirm(id) {
    let isLoading = false;

    Swal.fire({
        title: "¿Deseas eliminar la vacuna de esta persona?",
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
            await deletePersonVaccination(id, value).then(
                (res) => {
                    if (res.message === "ok") {
                        success("La vacuna de la persona fue eliminada", "");
                        window.location.reload();
                    } else {
                        error("Ocurrió un error al eliminar la vacuna de la persona.");
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
        // es necesario retornar una promesa para que se pause el modal
        // hasta no terminar, no es posible salir del modal
        // preConfirm: () => {
        //     // promise returned

        //     return deletePersonVaccination(id).then(
        //         (res) => {
        //             if (res.message === "ok") {
        //                 success("Vacuna de la persona eliminada", "");
        //                 window.location.reload();
        //             } else {
        //                 error(
        //                     "Ocurrió un error al eliminar la vacuna de esta persona."
        //                 );
        //             }
        //         },
        //         () => error("Ocurrió un error de conexión.")
        //     );
        // },
        ...deleteOrExitButtons,
    });
}
