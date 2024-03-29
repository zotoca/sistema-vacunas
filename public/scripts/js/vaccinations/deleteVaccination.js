import { deleteOrExitButtons, success, error } from "../helpers/sweetAlerts.js";
import { deleteVaccination } from "../helpers/requests.js";
import { selectorAll } from "../helpers/DOM.js";
document.addEventListener("DOMContentLoaded", () => {
    const btnsDeleteVaccionations = selectorAll("button[data-action='delete']");

    btnsDeleteVaccionations.forEach((btn) =>
        btn.addEventListener("click", () => {
            const id = +btn.getAttribute("data-id");
            deleteVaccinationConfirm(id);
        })
    );
});

function deleteVaccinationConfirm(id) {
    let isLoading = false;

    Swal.fire({
        title: "¿Deseas eliminar esta vacuna?",
        text:
            "Advertencia: Todas las vacunas de las personas asociadas a esta vacuna seran eliminadas.",
        icon: "warning",
        allowEscapeKey: false,
        allowOutsideClick: false,
        input: "password",
        inputLabel: "Escriba la contraseña para confirmar",
        inputValidator: async (value) => {
            if (!value) {
                return "El campo debe ser obligatorio";
            }
            isLoading = true;
            Swal.showLoading();
            await deleteVaccination(id, value).then(
                (res) => {
                    if (res.message === "ok") {
                        success("Vacuna eliminada", "");
                        window.location.reload();
                    } else {
                        error("Ocurrió un error al eliminar la vacuna.");
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
        allowOutsideClick: () => !isLoading,
        ...deleteOrExitButtons,
    });
}
