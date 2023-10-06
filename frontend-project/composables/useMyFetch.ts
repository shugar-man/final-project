import { useAuthStore } from "~/stores/useAuthStore"
type Headers = {[key: string] : string}

export default async function <T>(path: string, options: {}) {
  const config = useRuntimeConfig()
  const auth = useAuthStore()
  const headers : Headers = {
    "Accept": "application/json"
  }
  if (auth.isLogin) {
    headers['Authorization'] = `Bearer ${auth.token}`
  }

  return await useFetch<T>(path, {
    ...options,
    baseURL: config.public.apiBaseURL,
    headers
  })
}