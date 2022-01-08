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

    btnPrint.addEventListener("click", () => {
        vaccinations.querySelector("#ignorePDF").style.display = "none";

        html2canvas(vaccinations, {
            scale: 2,
            width: pdf.internal.pageSize.getWidth(),
            height: pdf.internal.pageSize.getHeight(),
        }).then((canvas) => {
            const img = canvas.toDataURL("image/png");

            const marginX = 100;
            const marginTop = 70;

            pdf.addImage(
                img,
                "PNG",
                marginX,
                marginTop,
                pdf.internal.pageSize.getWidth(),
                pdf.internal.pageSize.getHeight()
            );
            pdf.save("vacunas.pdf");
            vaccinations.querySelector("#ignorePDF").style.display = "";
        });
    });
});
