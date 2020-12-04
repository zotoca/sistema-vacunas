export const buttonsConfig = {
    showConfirmButton: true,
    showCancelButton: true,
    confirmButtonColor: "#28a745", // boostrap color
    cancelButtonColor: "#dc3545", // boostrap color
};

export const createOrExitButtons = {
    confirmButtonText: "Crear",
    cancelButtonText: "Salir",
    ...buttonsConfig,
};

export const deleteOrExitButtons = {
    cancelButtonText: "Salir",
    confirmButtonText: "Sí, eliminar",
    ...buttonsConfig,
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
