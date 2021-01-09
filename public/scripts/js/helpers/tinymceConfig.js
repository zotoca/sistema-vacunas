import isDarkMode from "./darkMode.js";

function propsInDarkMode() {
    return isDarkMode() ? { skin: "oxide-dark", content_css: "dark" } : {};
}

const commonConfig = {
    selector: "#content",
    plugins: "image code",
    toolbar: "image code",
    relative_urls: false,
    convert_urls: true,
    remove_script_host: false,
    height: "480px",
    forced_root_block: "",
    force_br_newlines: true,
    force_p_newlines: false,
    ...propsInDarkMode(),
};

export const configPost = {
    images_upload_url: "/foro/subir-imagen",
    ...commonConfig,
};

export const configNews = {
    images_upload_url: "/noticias/subir-imagen",
    ...commonConfig,
};
