<template>
    <div class="flex items-center justify-center">
      <div class="bg-white w-1/3 mt-10 rounded-lg p-6">
        <div class="flex items-center justify-center flex-col">
          
          <img :src=imageURL(auth.user.profile_image) class="rounded-full w-32" alt="Profile Picture">
          <h1 class="text-gray-800 font-semibold text-xl mt-5">{{ auth.user.name }}</h1>
          <div class="text-gray-400 text-sm mt-2">
            <p>Email: {{ auth.user.email }}</p>
            <p>Artwork Total: {{ art_total }}</p>
            <p>Tel: {{ auth.user.tel }}</p>
          </div>
          <nuxt-link to="/profile/edit">
            <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg px-4 py-2 mt-4">
            Edit Profile
          </button>
          </nuxt-link>

          <nuxt-link to="/profile/posts">
          <button class="bg-green-500 hover:bg-green-600 text-white font-semibold rounded-lg px-4 py-2 mt-2">
            View My Posts  
          </button>
        </nuxt-link>
        </div>
      </div>
    </div>

    
  </template>
  
  <script setup lang="ts">
  import { ref } from 'vue';
  import { useAuthStore } from '~/stores/useAuthStore';
  const route = useRoute()
  const auth = useAuthStore()
  // const user = ref({
  //   profilePicture: "/image/logo.jpg",
  //   username: "Username01",
  //   email: "user@example.com",
  //   birthDate: "January 1, 2023",
  //   artworkTotal: 10,
  //   likeTotal: 100,
  // });
  const idUser = ref({
    id: auth.user.id
})
  function imageURL(path:string) {
  return import.meta.env.VITE_BACKEND_IMG_URL + '/' + path
  }

  const { data: response, pending } = await useMyFetch<any>("/countPost", {
    method : "POST",
    body : idUser
  })
  const art_total = response.value;
  
  
  </script>
