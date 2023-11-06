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
        tel: ""
      },
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
    setUser(id: string,name: string, email: string, profile_image: string,role: number,tel: string) {
      this.user.id = id
      this.user.name = name
      this.user.email = email
      this.user.profile_image = profile_image
      this.user.role = role
      this.user.tel = tel
    },
    setProfileImage(new_profile_image: string){
      this.user.profile_image = new_profile_image
    },
    clear() {
      this.token = ''
      this.user.id = ''
      this.user.name = ''
      this.user.email = ''
      this.user.profile_image = ''
      this.user.role = 0;
      this.user.tel = ''
    },
  },
  persist: true
})
