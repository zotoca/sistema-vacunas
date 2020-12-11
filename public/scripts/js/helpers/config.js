//window.location.protocol
export const PROTOCOL =  window.location.protocol + "//";
export const BASE_URL = PROTOCOL + window.location.host;
export const VACCINATIONS_URL = BASE_URL + "/vacunas";
export const STREETS_URL = BASE_URL + "/calles";
export const HOUSES_URL = BASE_URL + "/casas";
export const PERSONS_URL = BASE_URL + "/personas";

// ---- API -----
export const BASE_API = BASE_URL + "/api";
export const STREETS_API_URL = BASE_API + "/calles";
export const HOUSES_API_URL = (houseId) =>`${BASE_API}/calles/${houseId}/casas`;