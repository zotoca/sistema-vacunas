import { getId, body } from "./DOM.js";

window.addEventListener("load", () => {
    getId("loader").classList.add("loader-hidden");
    body.style.overflowY = "auto";
});
