<template>
    <div class="relative" @click="toggleDropdown">
      <button class="bg-white">
        <img
          src="/image/Menu.png"
          width="50"
          height="60"
        />
      </button>
      <div
  v-if="isOpen"
  class="text-xl absolute mt-2 down-0 bg-green-400 border rounded-lg shadow-lg"
  style="z-index: 999;"
>
  <ul>
    <!-- <li><a href="#" class="text-gray-800 hover:bg-green-300">Topic</a></li>
    <li><a href="#" class="text-gray-800 hover:bg-green-300">Challenge</a></li> -->
    <li><nuxt-link :to="'/follows'" v-if="auth.token" class="text-gray-800 hover:bg-green-300">Following</nuxt-link></li>
  </ul>
</div>
    </div>
  </template>
  
  <script setup lang="ts">
  import { ref } from 'vue';
  import { useAuthStore } from '~/stores/useAuthStore'
  const auth = useAuthStore()
  // console.log(auth.id);
  console.log(auth.token);
  
  const isOpen = ref(false);
  
  const toggleDropdown = () => {
    isOpen.value = !isOpen.value;
  };
</script>