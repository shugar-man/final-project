<template>
    <div>
      <div class="bg-gray-700 text-gray-100 py-3.5 px-6 shadow md:flex justify-between item-center">
        <h1 class="animate-text-color text-4xl">Admin</h1>
      </div>
      <div class="bg-white p-6">
        <h2 class="text-2xl font-semibold mb-4">List of Items</h2>
        <div>
          <div v-for="item in items" :key="item.id" class="mb-2">
            {{ item.name }}
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup lang="ts">
  import { ref } from 'vue';
  const items = ref([
    { id: 1, name: 'Item 1' },
    { id: 2, name: 'Item 2' },
    { id: 3, name: 'Item 3' },
  ]);
  </script>
  
  <style scoped>
  @keyframes colorChange {
    0% { color: rgba(255, 255, 255, 1); }
    50% { color: rgb(15, 243, 30); }
    100% { color: rgba(255, 255, 255, 1); }
  }
  
  .animate-text-color {
    animation: colorChange 2s infinite;
  }
  </style>