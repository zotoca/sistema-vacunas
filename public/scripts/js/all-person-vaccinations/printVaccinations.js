window.addEventListener("DOMContentLoaded", () => {
    const jsPDF = jspdf.jsPDF;
    const pdf = new jsPDF({
        orientation: "p",
        unit: "px",
        format: "a4",
        compress: true,
        hotfixes: ["px_scaling"],
    });

    const btnPrint = document.getElementById("print");
    const vaccinations = document.getElementById("document");
    const ignorePdf = vaccinations.querySelector("#ignorePDF");
    let pdfName = ignorePdf.getAttribute("data-name").replace(/\s/g, "-");
    pdfName += "-vacunas.pdf";

    btnPrint.addEventListener("click", () => {
        btnPrint.style.display = "none";
        pdf.html(vaccinations, {
            callback: function (doc) {
                doc.save(pdfName);
                btnPrint.style.display = "block";
                window.open(URL.createObjectURL(doc.output("blob")));
            },
            x: 20,
            y: 20,

            html2canvas: {
                scale: "1",
                scrollX: 0,
                scrollY: 0,
            },
        });
    });
});
