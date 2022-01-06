import { createOrExitButtons, success, error } from "../helpers/sweetAlerts.js";
import { createPersonVaccination } from "../helpers/requests.js";
import { getId } from "../helpers/DOM.js";

document.addEventListener("DOMContentLoaded", async () => {
    const loadInputs = async () => {
        let vaccinationSelect = await loadVaccinationSelect();

        let doseInput =
            `<select name="dose" class="swal2-input" id="person-vaccination-dose"  placeholder="Dosis">
                <option value=1>1</option>
                <option value=2>2</option>
                <option value=3>3</option>
                <option value=4>4</option>
                <option value=5>5</option>
                <option value=6>6</option>
                <option value=7>7</option>
                <option value=8>8</option>
                <option value=9>9</option>
            </select>`;

        let lotNumberInput =
            '<input type="text" name="lot_number" class="swal2-input" id="person-vaccination-lot-number"  placeholder="Numero de lote"/>';

        let dateInput =
            '<input type="date" name="vaccination_date" class="swal2-input" id="person-vaccination-vaccination-date"  placeholder="Fecha de vacunacion">';

        let isVaccinatedInput =
            '<label><input type="checkbox" name="is_vaccinated" class="swal2-checkbox" id="person-vaccination-is-vaccinated">¿Esta vacunado?</label>';

        return (
            vaccinationSelect +
            doseInput +
            lotNumberInput +
            dateInput +
            isVaccinatedInput
        );
    };

    let loadVaccinationSelect = async () => {
        //Cargamos la primera parte del select
        let vaccinationSelect =
            '<select name="vaccination_id" class="swal2-input" id="person-vaccination-vaccination-id"><option value="" disabled selected>Coloca la vacuna</option>';
        //Obtenemos todos los datos de la vacuna
        let vaccinations = await axios
            .get("/api/vacunas")
            .then((response) => response.data);

        //Vamos cargando elementod DOM option en el select con la informacion de cada vacuna
        vaccinations.forEach((vaccination) => {
            vaccinationSelect += `<option value="${vaccination.id}">${vaccination.name}</option>`;
        });
        //Retornamos el elemento select preparado;
        return (vaccinationSelect += "</select>");
    };

    const btnCreatePersonVaccination = getId("create-person-vaccination");

    let inputHtml = await loadInputs();

    btnCreatePersonVaccination.addEventListener("click", async () => {
        Swal.fire({
            title: "Crear una vacuna",
            html: inputHtml,
            allowEscapeKey: false,
            preConfirm: async (nothing) => {
                let personId = getId("person-id").value;
                let vaccinationId = getId("person-vaccination-vaccination-id")
                    .value;
                let dose = getId("person-vaccination-dose").value;
                let lotNumber = getId("person-vaccination-lot-number").value;
                let vaccinationDate = getId(
                    "person-vaccination-vaccination-date"
                ).value;
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

                try {
                    const res = await createPersonVaccination(
                        vaccinationId,
                        personId,
                        dose,
                        lotNumber,
                        vaccinationDate,
                        isVaccinated
                    );
                    if (res.message === "ok") {
                        success(
                            "Vacuna de la persona creada",
                            "La vacuna de la persona se creó con exito."
                        );
                        window.location.reload();
                    } else {
                        error("Ocurrió un error al crear la vacuna.");
                    }
                } catch (e) {
                    console.log(e);
                    error("Ocurrió un error de conexión.");
                }
            },
            allowOutsideClick: () => !Swal.isLoading(), // don't exit while loading fetch
            showLoaderOnConfirm: true,
            ...createOrExitButtons,
        });
    });
});
