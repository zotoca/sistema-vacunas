import { getId, body } from "./DOM.js";

window.addEventListener("DOMContentLoaded", () => {
    const isDarkMode = JSON.parse(localStorage.getItem("isDarkMode"));
    const label = getId("dark-mode");
    const chkbox = getId("dark-mode-toggler");
    //fa-sun
    if (isDarkMode) {
        chkbox.checked = true;
        setDarkMode();
    }

    chkbox.addEventListener("change", ({ target }) => {
        const isDarkMode = target.checked;
        localStorage.setItem("isDarkMode", isDarkMode);
        setDarkMode(isDarkMode);
    });

    function setDarkMode(isDarkMode = true) {
        const icon = label.querySelector("i.fa");

        if (isDarkMode) {
            body.classList.add("dark-mode");
            icon.className = "fa fa-sun text-warning";
        } else {
            body.classList.remove("dark-mode");
            icon.className = "fa fa-moon";
        }
    }
});
