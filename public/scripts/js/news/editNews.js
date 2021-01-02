document.addEventListener("DOMContentLoaded", () => {
    tinymce.init({
        selector:'#content',
        plugins: 'image code',
        toolbar: 'image code',
        relative_urls : false,
        convert_urls : true,
        remove_script_host : false, 
        images_upload_url: '/noticias/subir-imagen',
        height:"480px"
    });
});
