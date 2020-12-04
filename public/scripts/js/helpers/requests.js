import { VACCINATIONS_URL } from "./config.js";

export async function createVaccination(name) {
    const res = await axios.post(VACCINATIONS_URL, { name });
    return res.data;
}

export async function deleteVaccination(id) {
    const res = await axios.delete(`${VACCINATIONS_URL}/${id}`);
    return res.data;
}

export async function editVaccination(name, id) {
    const res = await axios.put(`${VACCINATIONS_URL}/${id}`, { name });
    return res.data;
}
