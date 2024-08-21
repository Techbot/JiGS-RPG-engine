import axios, { AxiosResponse } from "axios";

export const JIGS_URL = import.meta.env.VITE_DRUPAL_URL;

export function jigsGet(url: string): Promise<AxiosResponse> {
  // Normalize the URL to ensure no double slashes
  const normalizedUrl = url.startsWith('/') ? `${JIGS_URL}${url}` : `${JIGS_URL}/${url}`;
  return axios.get(normalizedUrl);
}
