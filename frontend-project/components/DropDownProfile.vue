<template>
    <div class="relative px-2" @click="toggleDropdown">
      <button class="text-xl bg-green-400 text-gray-800 px-4 py-2 rounded-md flex items-center hover:bg-green-300">
        <img
        :src="imageURL(auth.user.profile_image)"
          class="w-8 h-8 rounded-full mr-2"
        />
        Profile
      </button>
      <div
        v-if="isOpen"
        class="text-xl absolute right-0 mt-2 w-48 bg-green-400 border rounded-lg shadow-lg" style="z-index: 999;"
      >
        <ul>
          <nuxt-link :to="`/page/${auth.user.id}`"  v-if="auth.isLogin" class="text-gray-800 hover:bg-green-300">Your Page</nuxt-link>
            <!-- <li><a href="/page/{auth.id}" v-if="auth.isLogin" class="text-gray-800 hover:bg-green-300">Your Profile</a></li> -->
            <li><a href="/profile" v-if="auth.isLogin" class="text-gray-800 hover:bg-green-300">Profile</a></li>
            <li><a href="/login" v-if="!auth.isLogin" class="text-gray-800 hover:bg-green-300">Sign In</a></li>
            <li><a href="/" @click="logout" v-if="auth.isLogin" class="text-gray-800 hover:bg-green-300">Sign Out</a></li>
        </ul>
      </div>
    </div>
  </template>
  
  <script setup lang="ts">
  import { ref } from 'vue';
  import { useAuthStore } from '~/stores/useAuthStore';
  const auth = useAuthStore() 
  
  function imageURL(path:string) {
    if(path === ""){
      return "images/users/picture.png"
    }
    console.log(path);
    
  return import.meta.env.VITE_BACKEND_IMG_URL + '/' + path
  };
  async function logout() {
  const confirmLogout = confirm("Do you want to Sign Out?");
  if(confirmLogout){
    if (auth.isLogin) {
    const { data: user, error } = await useMyFetch<any>('auth/logout', {
    method: 'POST'
    })
    auth.clear();
  }
  }
}



  const isOpen = ref(false);
  
  const toggleDropdown = () => {
    isOpen.value = !isOpen.value;
  };
</script>


