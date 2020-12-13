import {
    VACCINATIONS_URL,
    STREETS_URL,
    HOUSES_URL,
    PERSONS_URL,
    PERSON_EDIT_URL,
    STREETS_API_URL,
    HOUSES_API_URL,
    DNI_CHECK_URL,
} from "./config.js";
import POST, { DELETE, PUT, GET } from "./http.js";

export function createVaccination(name) {
    return POST(VACCINATIONS_URL, { name });
}

export async function deleteVaccination(id) {
    return DELETE(`${VACCINATIONS_URL}/${id}`);
}

export async function editVaccination(name, id) {
    return PUT(`${VACCINATIONS_URL}/${id}`, { name });
}

export function createStreet(name) {
    return POST(STREETS_URL, { name });
}

export async function deleteStreet(id) {
    return DELETE(`${STREETS_URL}/${id}`);
}

export async function editStreet(name, id) {
    return PUT(`${STREETS_URL}/${id}`, { name });
}

export function createHouse(number, street_id) {
    return POST(HOUSES_URL, { number, street_id });
}

export async function deleteHouse(id) {
    return DELETE(`${HOUSES_URL}/${id}`);
}

export async function editHouse(number, id) {
    return PUT(`${HOUSES_URL}/${id}`, { number });
}

export async function createPerson(person) {
    return POST(`${PERSONS_URL}/`, person);
}

export async function editPerson(personId, data) {
    return PUT(PERSON_EDIT_URL(personId), data);
}

export async function deletePerson(id) {
    return DELETE(`${PERSONS_URL}/${id}`);
}

export async function getStreets() {
    return GET(STREETS_API_URL);
}

export async function getHouses(streetId) {
    return GET(HOUSES_API_URL(streetId));
}

export async function isValidDni(dni) {
    return POST(DNI_CHECK_URL, { dni });
}
