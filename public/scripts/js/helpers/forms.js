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
            console.log(e.target);
            if (e.target.value.length <= 0) {
                e.target.classList.add("bad");
            } else {
                e.target.classList.remove("bad");
            }
        });
    }
}
