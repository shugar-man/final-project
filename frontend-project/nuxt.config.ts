// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  runtimeConfig: {
    public: {
      apiBaseURL: 'http://localhost/api/'
    }
  },
  devtools: { enabled: true },
  css: ['~/assets/css/main.css'],
  modules: [
  '@vueuse/nuxt',
  '@pinia/nuxt',
  '@pinia-plugin-persistedstate/nuxt',
  ],
  postcss: {
    plugins: {
      tailwindcss: {},
      autoprefixer: {},
    },
  },
})
