import { eidtOrExitButtons, success, error } from "../helpers/sweetAlerts.js";
import { editPersonVaccination } from "../helpers/requests.js";
import { selectorAll, getId } from "../helpers/DOM.js";

window.addEventListener("DOMContentLoaded", () => {
    const btnsEditPersonVaccination = selectorAll("button[data-action='edit']");

    btnsEditPersonVaccination.forEach((btn) =>
        btn.addEventListener("click", () => {
            const id = +btn.getAttribute("data-id");
            const vaccinationId = btn.getAttribute("data-vaccination-id");
            const dose = btn.getAttribute("data-dose");
            const vaccinationDate = btn.getAttribute("data-vaccination-date");
            const lotNumber = btn.getAttribute("data-lot-number");
            const isVaccinated = btn.getAttribute("data-is-vaccinated");
            editPersonVaccinationConfirm(
                id,
                vaccinationId,
                dose,
                lotNumber,
                vaccinationDate,
                isVaccinated
            );
        })
    );
});

async function editPersonVaccinationConfirm(
    id,
    vaccinationId,
    dose,
    lotNumber,
    vaccinationDate,
    isVaccinated
) {
    let inputHtml = await loadInputs(
        vaccinationId,
        dose,
        lotNumber,
        vaccinationDate,
        isVaccinated
    );

    Swal.fire({
        title: "Editar vacuna de la persona",
        icon: "warning",
        html: inputHtml,
        allowEscapeKey: false,
        showLoaderOnConfirm: true,
        allowOutsideClick: () => !Swal.isLoading(),
        // es necesario retornar una promesa para que se pause el modal
        // hasta no terminar, no es posible salir del modal
        preConfirm: (nothing) => {
            let vaccinationId = getId("person-vaccination-vaccination-id")
                .value;
            let dose = getId("person-vaccination-dose").value;
            let lotNumber = getId("person-vaccination-lot-number").value;
            let vaccinationDate = getId("person-vaccination-vaccination-date")
                .value;
            let isVaccinated = getId("person-vaccination-is-vaccinated")
                .checked;

            if (!vaccinationId) {
                error("La vacuna es obligatoria.");
                return;
            }
            if (!vaccinationDate) {
                error("La fecha de la vacuna es obligatoria.");
                return;
            }

            // promise returned
            return editPersonVaccination(
                id,
                vaccinationId,
                dose,
                lotNumber,
                vaccinationDate,
                isVaccinated
            ).then(
                (res) => {
                    if (res.message === "ok") {
                        success("Vacuna de la persona editada", "");
                        window.location.reload();
                    } else {
                        error("Ocurrió un error al editar la vacuna.");
                    }
                },
                () => error("Ocurrió un error de conexión.")
            );
        },
        ...eidtOrExitButtons,
    });
}

let loadInputs = async (
    vaccinationId,
    dose,
    lotNumber,
    vaccinationDate,
    isVaccinated
) => {
    let vaccinationSelect = await loadVaccinationSelect(vaccinationId);

    let doseInput = `<input type="text" name="dose" class="swal2-input" id="person-vaccination-dose" value="${dose}" placeholder="Dosis"/>`;

    let lotNumberInput = `<input type="text" name="lot_number" class="swal2-input" id="person-vaccination-lot-number" value="${lotNumber}" placeholder="Numero de lote"/>`;

    let dateInput = `<input type="date" name="vaccination_date" class="swal2-input" id="person-vaccination-vaccination-date" value="${vaccinationDate}" placeholder="Fecha de vacunacion">`;

    let isVaccinatedInput =
        '<label><input type="checkbox" name="is_vaccinated" class="swal2-checkbox" ' +
        (isVaccinated == 1 ? "checked" : "") +
        ' id="person-vaccination-is-vaccinated">¿Esta vacunado?</label>';

    return (
        vaccinationSelect +
        doseInput +
        lotNumberInput +
        dateInput +
        isVaccinatedInput
    );
};

let loadVaccinationSelect = async (vaccinationId) => {
    //Cargamos la primera parte del select
    let vaccinationSelect =
        '<select name="vaccination_id" class="swal2-input" id="person-vaccination-vaccination-id"><option value="" disabled selected>Coloca la vacuna</option>';
    //Obtenemos todos los datos de la vacuna
    let vaccinations = await axios
        .get("/api/vacunas")
        .then((response) => response.data);

    //Vamos cargando elemento DOM option en el select con la informacion de cada vacuna
    vaccinations.forEach((vaccination) => {
        vaccinationSelect +=
            `<option value="${vaccination.id}" ` +
            (vaccinationId == vaccination.id ? "selected" : "") +
            `>${vaccination.name}</option>`;
    });
    //Retornamos el elemento select preparado;
    return (vaccinationSelect += "</select>");
};
