export const PROTOCOL = window.location.protocol + "//";
export const BASE_URL = PROTOCOL + window.location.host;
export const VACCINATIONS_URL = BASE_URL + "/vacunas";
export const STREETS_URL = BASE_URL + "/calles";
export const HOUSES_URL = BASE_URL + "/casas";
export const PERSONS_URL = BASE_URL + "/personas";
export const POSTS_URL = BASE_URL + "/foro";
export const COMMENTS_URL = BASE_URL + "/comentarios";


// ----------------- API ------------------------------
export const BASE_API = BASE_URL + "/api";
export const STREETS_API_URL = BASE_API + "/calles";
export const PERSON_EDIT_URL = (personId) => `${BASE_API}/personas/${personId}`;
export const PERSON_VACCINATIONS_URL = `${BASE_API}/vacunas-personas`;
export const HOUSES_API_URL = (houseId) =>
`${BASE_API}/calles/${houseId}/casas`;
export const DNI_CHECK_URL = BASE_API + "/personas/verificar-cedula";
export const ADMIN_URL = BASE_URL + "/administradores";
