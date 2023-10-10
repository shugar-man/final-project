<template>
  <h2>หน้าโพสต์</h2>
  <div>{{ auth.user.name }}</div>

  <div v-if="pending">
    Pending...
  </div>
  <div v-else v-for="post in posts.data" :key="post.id">
    <div class="m-4 text-blue-600">

      <nuxt-link :to="`/posts/${post.id}`">
        {{ post.name }}
      </nuxt-link>
      <div class="">
        <img :src=post.user_profile_image>
      </div>
      <div></div>
      <nuxt-link :to="`/page/${post.id}`">
        {{ post.user_name }}
      </nuxt-link>
    </div>
  </div>
</template>

<script setup lang="ts">
import { useAuthStore } from '~/stores/useAuthStore'
const auth = useAuthStore()
// const config = useRuntimeConfig()
// const { data: users, pending } = await useMyFetch<any>("/", {})
const { data: posts, pending } = await useMyFetch<any>("/", {})
console.log(posts)

</script>