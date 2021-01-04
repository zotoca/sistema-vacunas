import { getId, body } from "./DOM.js";

export default function isDarkMode() {
    return JSON.parse(localStorage.getItem("isDarkMode"));
}

document.addEventListener("DOMContentLoaded", () => {
    const isDarkModeFlag = isDarkMode();
    const label = getId("dark-mode");
    const chkbox = getId("dark-mode-toggler");

    if (isDarkModeFlag && chkbox) {
        chkbox.checked = true;
        setDarkMode();
    }

    chkbox.addEventListener("change", ({ target }) => {
        const isDarkModeFlag = target.checked;
        localStorage.setItem("isDarkMode", isDarkModeFlag);
        setDarkMode(isDarkModeFlag);
    });

    function setDarkMode(isDarkModeFlag = true) {
        const icon = label.querySelector("i.fa");

        if (isDarkModeFlag) {
            body.classList.add("dark-mode");
            icon.className = "fa fa-sun text-warning";
        } else {
            body.classList.remove("dark-mode");
            icon.className = "fa fa-moon";
        }
    }
});
