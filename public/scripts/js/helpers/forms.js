import { error } from "./sweetAlerts.js";

export default function isValidForm(
    form,
    inputsName = [],
    showAlertError = false
) {
    for (const inputName of inputsName) {
        const input = form[inputName];
        if (!input.value) {
            input.classList.add("bad");
            input.scrollIntoView();
            showAlertError && error("Verifica los campos, faltan datos.");
            return false;
        }
    }
    return true;
}

export function checkEmptyInputsInForm(form, inputsName = []) {
    for (const inputName of inputsName) {
        const input = form[inputName];
        const dynamicEvent =
            input.nodeName === "SELECT" || input.type === "date"
                ? "change"
                : "keyup";

        input.addEventListener(dynamicEvent, (e) => {
            if (
                e.target.value.length <= 0 ||
                e.target.value === "" ||
                e.target.value === undefined
            ) {
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
