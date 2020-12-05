import { VACCINATIONS_URL, STREETS_URL } from "./config.js";

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

export async function createStreet(name) {
    const res = await axios.post(STREETS_URL, { name });
    return res.data;
}

export async function deleteStreet(id) {
    const res = await axios.delete(`${STREETS_URL}/${id}`);
    return res.data;
}

export async function editStreet(name, id) {
    const res = await axios.put(`${STREETS_URL}/${id}`, { name });
    return res.data;
}