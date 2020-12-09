import { error } from "./sweetAlerts.js";

export default function isValidForm(form, inputsName = []) {
    for (const inputName of inputsName) {
        const input = form[inputName];
        if (!input.value) {
            input.classList.add("bad");
            input.scrollIntoView();
            error("Verifica los campos, faltan datos.");
            return false;
        }
    }
    return true;
}

export function isEmptyInputsForm(form, inputsName = []) {
    for (const inputName of inputsName) {
        const input = form[inputName];
        const dynamicEvent = input.nodeName === "SELECT" ? "change" : "keyup";

        input.addEventListener(dynamicEvent, (e) => {
            if (e.target.value.length <= 0) {
                e.target.classList.add("bad");
            } else {
                e.target.classList.remove("bad");
            }
        });
    }
}

export function checkEmptyValueFormData(formData) {
    const fd = new FormData();
    for (const [key, value] of formData.entries()) {
        if (value) {
            fd.append(key, value);
        }
    }
    return fd;
}
