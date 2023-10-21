<template>
    <div class="flex items-center justify-center">
      <div class="bg-white w-1/3 mt-10 rounded-lg p-6">
        <div class="flex items-center justify-center flex-col">
          
          <img :src="imgUrl" class="rounded-full w-32" alt="Profile Picture">
          <h1 class="text-gray-800 font-semibold text-xl mt-5">{{ auth.user.name }}</h1>
          <div class="text-gray-400 text-sm mt-2">
            <p>Email: {{ auth.user.email }}</p>
            <p>Birth Date: {{ user.birthDate }}</p>
            <p>Artwork Total: {{ user.artworkTotal }}</p>
            <p>Like Total: {{ user.likeTotal }}</p>
          </div>
          <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg px-4 py-2 mt-4">
            Edit Profile
          </button>
          <button class="bg-green-500 hover:bg-green-600 text-white font-semibold rounded-lg px-4 py-2 mt-2">
            View My Posts
            <!-- <div v-for="post in posts.posts" :key="post.id">
                <div class="text-xl mx-6 my-2">
                    {{ post.image }}
                </div>
            </div> -->
          </button>
        </div>
      </div>
    </div>

    
  </template>
  
  <script setup lang="ts">
  import { ref } from 'vue';
  import { useAuthStore } from '~/stores/useAuthStore';
  
  const auth = useAuthStore()
  const imgUrl = "http://localhost"+ auth.storeImageUrl+auth.user.profile_image
  const user = ref({
    profilePicture: "/image/logo.jpg",
    username: "Username01",
    email: "user@example.com",
    birthDate: "January 1, 2023",
    artworkTotal: 10,
    likeTotal: 100,
  });
  </script>
