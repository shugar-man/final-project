<template>
  <h2>Artists</h2>

  <div v-if="pending">
    Pending...
  </div>
  <div v-else v-for="post in posts" :key="post.id">
    <div class="m-4 text-blue-600">
      <nuxt-link :to="`/posts/${post.id}`">
        {{ post.name }}
      </nuxt-link>
    </div>
  </div>
</template>

<script setup lang="ts">
// const config = useRuntimeConfig()
const { data: posts, pending } = await useMyFetch<any>("post", {})
console.log(posts)
</script>