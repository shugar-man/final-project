import { defineStore } from 'pinia'

export const useAuthStore = defineStore('auth', {
  state: () => {
    return { 
      token: "",
      user: {
        name: "",
        email: "",
        profile_image: ""
      }
    }
  },
  getters: {
    isLogin: (state) => state.token !== ""
  },
  actions: {
    setNewToken(token: string) {
      this.token = token
    },
    setUser(name: string, email: string, profile_image: string) {
      this.user.name = name
      this.user.email = email
      this.user.profile_image = profile_image
    },
    clear() {
      this.token = ''
      this.user.name = ''
      this.user.email = ''
      this.user.profile_image = ''
    },
    
  },
  persist: true
})