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

export const eidtOrExitButtons = {
    cancelButtonText: "Salir",
    confirmButtonText: "Sí, editar",
    ...buttonsConfig,
};

export function error(text = "") {
    Swal.fire("Ocurrió un error", text, "error");
}

export function success(title = "", text = "" ) {
    Swal.fire(title, text, "success");
}
