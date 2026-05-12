
import { API_KEYS, API_URLS } from "../config/apis.js";

export async function buscarEnScopus(query) {
  const url = `${API_URLS.SCOPUS}?query=${encodeURIComponent(query)}&apiKey=${API_KEYS.SCOPUS}`;
  
  const response = await fetch(url, {
    headers: { "X-ELS-APIKey": API_KEYS.SCOPUS }
  });
  
  return response.json();
}

export async function buscarEnScienceDirect(query) {
  const url = `${API_URLS.SCIENCEDIRECT}?query=${encodeURIComponent(query)}&apiKey=${API_KEYS.SCIENCEDIRECT}`;
  
  const response = await fetch(url, {
    headers: { "X-ELS-APIKey": API_KEYS.SCIENCEDIRECT }
  });
  
  return response.json();
}
