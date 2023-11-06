import { defineStore } from 'pinia'
export const useAuthStore = defineStore('auth', {
  state: () => {
    return { 
      token: "",
      id: '',
      name: '',
      email: '',
      profile_image: '',
      user: {
        id: "",
        name: "",
        email: "",
        profile_image: "",
        role: 0,
      },
      storeImageUrl: "/api/images/"
    }
  },
  getters: {
    isLogin: (state) => state.token !== "",
    isAdmin: (state) => state.user.role === 1,
  },
  actions: {
    setNewToken(token: string) {
      this.token = token
    },
    setUser(id: string,name: string, email: string, profile_image: string,role: number) {
      this.user.id = id
      this.user.name = name
      this.user.email = email
      this.user.profile_image = profile_image
      this.user.role = role
    },
    clear() {
      this.token = ''
      this.user.id = ''
      this.user.name = ''
      this.user.email = ''
      this.user.profile_image = ''
      this.user.role = 0;
    },
    
  },
  persist: true
})
