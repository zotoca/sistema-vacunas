import { createOrExitButtons, success, error } from "../helpers/sweetAlerts.js";
import { deleteVaccination } from "../helpers/requests.js";

window.addEventListener("DOMContentLoaded", () => {
    const btnsDeleteVaccionations = document.querySelectorAll(
        "button[data-action='delete']"
    );

    btnsDeleteVaccionations.forEach((btn) =>
        btn.addEventListener("click", () => {
            const id = +btn.getAttribute("data-id");
            //deleteVaccination(id);
            deleteVaccinationConfirm();
        })
    );
});

function deleteVaccinationConfirm() {
    Swal.fire({
        title: "¿Deseas eliminar esta vacuna?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#28a745",
        cancelButtonColor: "#dc3545",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText : "Salir"
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire("Deleted!", "Your file has been deleted.", "success");
        }
    });
}
