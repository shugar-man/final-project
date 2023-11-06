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
        name: '',
        email: '',
        profile_image: ''
      },
      storeImageUrl: "/api/images/"
    }
  },
  getters: {
    isLogin: (state) => state.token !== "",
  },
  actions: {
    setNewToken(token: string) {
      this.token = token
    },
    setUser(id: string,name: string, email: string, profile_image: string) {
      this.id = id
      this.name = name;
      this.email = email;
      this.profile_image = profile_image;
      // this.user.name = name;
      // this.user.email = email;
      // this.user.profile_image = profile_image;
    },
    clear() {
      this.token = ''
      this.id = ''
      this.name = ''
      this.email = ''
      this.profile_image = ''
      // this.user.name = ''
      // this.user.email = ''
      // this.user.profile_image = ''
    },
    
  },
  persist: true
})
