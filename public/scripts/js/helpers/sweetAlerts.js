export const createOrExitButtons = {
    showConfirmButton: true,
    confirmButtonColor: "#28a745", // boostrap color
    confirmButtonText: "Crear",

    showCancelButton: true,
    cancelButtonColor: "#dc3545", // boostrap color
    cancelButtonText: "Salir",
};

export function error(text = "") {
    Swal.fire({
        titleText: "Ocurrió un error",
        icon: "error",
        text,
    });
}

export function success({ title = "", text = "" }) {
    Swal.fire({
        titleText: title,
        icon: "success",
        text,
    });
}
