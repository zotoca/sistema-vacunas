import { error } from "./sweetAlerts.js";

export function isImage(input) {
    const imgFile = input.files[0];
    if (!imgFile.type.startsWith("image/")) {
        input.value = null;
        error("Seleccione un archivo formato imagen");
        return false;
    }
    return true;
}
