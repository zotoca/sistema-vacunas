import isDarkMode from "./darkMode.js";

function propsInDarkMode() {
    return isDarkMode() ? { skin: "oxide-dark", content_css: "dark" } : {};
}

export const configPost = {
    selector: "#content",
    plugins: "image code",
    toolbar: "image code",
    relative_urls: false,
    convert_urls: true,
    remove_script_host: false,
    images_upload_url: "/foro/subir-imagen",
    height: "480px",
    forced_root_block: "",
    force_br_newlines: true,
    force_p_newlines: false,
    ...propsInDarkMode(),
};
