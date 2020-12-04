import { VACCINATIONS_URL } from "./config.js";

export async function createVaccination(name) {
    const res = await axios.post(VACCINATIONS_URL, { name });
    return res.data;
}
