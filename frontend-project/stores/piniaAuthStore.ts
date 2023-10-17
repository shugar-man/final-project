import { createPinia, defineStore } from 'pinia';

const pinia = createPinia();

export const useJwtStore = defineStore('jwt', {
  state: () => ({
    token: "",
  }),
  getters: {
    isAuthenticated: (state) => !!state.token,
    getToken: (state) => state.token,
  },
  actions: {
    setToken(token :string) {
      this.token = token;
    },
    clearToken() {
      this.token = "";
    },
  },
});

export { pinia };