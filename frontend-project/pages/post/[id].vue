<template>
    <div class="flex justify-center items-center h-screen bg-gray-200">
      <div class="bg-white p-6 rounded-lg shadow-lg relative">
        <button @click="deletePost" v-if="isAdmin" class="bg-red-500 text-white hover:bg-red-600 absolute top-2 right-2">
          Delete
        </button>
        <h1 class="text-2xl font-semibold">{{ post.title }}</h1>
        <p>Artist: {{ post.artist }}</p>
        <p>Description: {{ post.description }}</p>
        <p>Like : {{ post.likeCount }}</p>
        <p>Comment : {{ post.commentCount }}</p>
        <p>Reported : {{ post.reportedCount }} (Admin)</p>
        <p>Reported Details: {{ post.reportedDetails }} (Admin)</p>
        <img :src="post.imageUrl" alt="Artwork" class="w-full h-48 object-cover mt-4">
      </div>
    </div>
</template>
  
<script setup lang="ts">
  import { ref } from 'vue';
  import { useRouter } from 'vue-router';
  
  const router = useRouter();
  
  const post = ref({
    id: '1',
    title: 'Artwork 1',
    artist: 'Artist 1',
    imageUrl: '/image/defaultProfile.jpg',
    reportedCount: 3,
    description: 'Description of artwork 1',
    likeCount: 10,
    commentCount: 5,
    reportedDetails: 'reason of reported',
  });
  
  const isAdmin = true;
  
  const deletePost = () => {
    
  };
</script>
  
<style scoped>
  
  .container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #f0f0f0;
  }
</style>