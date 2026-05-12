
import { API_KEYS, API_URLS } from "../config/apis.js";

export async function buscarEnElibro(query) {
  const url = `${API_URLS.ELIBRO}/api/v1/search?q=${encodeURIComponent(query)}&token=${API_KEYS.ELIBRO}`;
  
  const response = await fetch(url);
  return response.json();
}

