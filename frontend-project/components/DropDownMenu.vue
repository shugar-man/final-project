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
      >
        <ul>
          <li><a href="#" class="text-gray-800 hover:bg-green-300">Topic</a></li>
          <li><a href="#" class="text-gray-800 hover:bg-green-300">Challenge</a></li>
          <li><a href="#" class="text-gray-800 hover:bg-green-300">Following</a></li>
        </ul>
      </div>
    </div>
  </template>
  
  <script setup lang="ts">
  import { ref } from 'vue';
  
  const isOpen = ref(false);
  
  const toggleDropdown = () => {
    isOpen.value = !isOpen.value;
  };
</script>