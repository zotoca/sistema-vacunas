window.addEventListener("DOMContentLoaded", () => {
    const jsPDF = jspdf.jsPDF;
    const pdf = new jsPDF();

    pdf.setFontSize(12);

    const btnPrint = document.getElementById("print");
    const vaccinations = document.getElementById("person-vaccinations");

    btnPrint.addEventListener("click", () => {
        pdf.html(vaccinations, {
            callback: function (pdf) {
                pdf.save("vacunas.pdf");
            },
            x: 10,
            y: 10,
        });
    });

    // pdf.text("Hello world!", 10, 10);
    // pdf.save("a4.pdf");
    console.log(pdf);
});
