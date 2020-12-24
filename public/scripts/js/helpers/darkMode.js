window.addEventListener("DOMContentLoaded", () => {
    const isDarkMode = JSON.parse(localStorage.getItem("isDarkMode"));
    const chkbox = document.getElementById("dark-mode-toggler");

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
        if (isDarkMode) {
            document.body.classList.add("dark-mode");
        } else {
            document.body.classList.remove("dark-mode");
        }
    }
});
