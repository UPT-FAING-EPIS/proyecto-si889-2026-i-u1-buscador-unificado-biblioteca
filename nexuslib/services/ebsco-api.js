
import { API_KEYS } from "../config/apis.js";

let sessionToken = null;

export async function autenticarEBSCO() {
  const response = await fetch("https://eds-api.ebscohost.com/authservice/rest/uidauth", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      Profile: API_KEYS.EBSCO.profile,
      Password: API_KEYS.EBSCO.password
    })
  });
  
  const data = await response.json();
  sessionToken = data.AuthToken;
  return sessionToken;
}

export async function buscarEnEBSCO(query) {
  if (!sessionToken) await autenticarEBSCO();
  
  const url = `https://eds-api.ebscohost.com/edsapi/rest/Search?query=${encodeURIComponent(query)}`;
  
  const response = await fetch(url, {
    headers: { "x-authenticationToken": sessionToken }
  });
  
  return response.json();
}
