<template>
    <h1>{{ pageTitle }}</h1>
  
    <div v-if="post" class="text-3xl mx-4">
      {{ post.name }} {{  post.id }}
    </div>
  
  </template>
  
  <script setup lang="ts">
  const route = useRoute()
  // const config = useRuntimeConfig()
  // console.log(config.public.apiBaseURL)
  const pageTitle = `Artist No. ${route.params.id}`
  
  
  const { data: post } = await useMyFetch<any>(
    `post/${route.params.id}`,
    {}
  )
  
  
  </script>