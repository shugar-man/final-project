<template>
  <div>
    <div class="bg-gray-700 text-gray-100 py-3.5 px-6 shadow md:flex justify-between item-center">
      <h1 class="animate-text-color text-4xl">Admin</h1>
    </div>
    <div v-if="pending">
      Loading...
    </div>
    <div v-else>
      <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        <div v-for="post in posts" :key="post.id" class="post-container border border-gray-200 rounded-md overflow-hidden bg-gray-900 text-white">
          <img :src="post.imageUrl" alt="Artwork" class="w-full h-48 object-cover">
          <div class="p-4">
            <div class="flex items-center justify-between">
              <h3 class="text-lg font-semibold">{{ post.title }} - Reported: {{ post.reportedCount }}</h3>
            </div>
            <p class="text-white">
              {{ post.artist }}
            </p>
            <div class="flex items-center justify-between mt-4">
              <button @click="likePost(post.id)" class="text-blue-500 hover:text-blue-700">
                Like
              </button>
              <button @click="commentPost(post.id)" class="text-blue-500 hover:text-blue-700">
                Comment
              </button>
            </div>
            <button @click="ViewPost(post.id)" class="text-blue-500 hover:text-blue-700">
              View Details
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="absolute bottom-0 right-0 mb-12 mr-4">
      <MenuLink to="/post">Post</MenuLink>
    </div>
    <div class="absolute bottom-0 right-0 mb-1 mr-4">
      <MenuLink to="/post">Next page</MenuLink>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
//import PostDetailPopup from '~/components/PostDetailPopup.vue';
//const { data: posts, pending } = await useFetch<any>("post", {})
const posts = ref([
  {
    id: 1,
    title: 'Artwork 1',
    artist: 'Artist 1',
    imageUrl: '/image/defaultProfile.jpg',
    reportedCount: 3, 
  },
  {
    id: 2,
    title: 'Artwork 2',
    artist: 'Artist 2',
    imageUrl: '/image/defaultProfile.jpg',
    reportedCount: 2, 
  },
  
]);
const pending = ref(false);

const likePost = (postId: number) => {
  console.log(`Liked post with ID ${postId}`);
};

const commentPost = (postId: number) => {
  console.log(`Commented on post with ID ${postId}`);
};

const ViewPost = (postId: number) => {
  console.log(`Viewed on post with ID ${postId}`);
};

const deletePost = (postId: number) => {
  console.log(`Commented on post with ID ${postId}`);
};


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