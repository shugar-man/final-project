<template>
    <h1>{{ pageTitle }}</h1>
  
    <div v-if="post" class="text-3xl mx-4">
      {{ post.name }} {{  post.status }}
    </div>
  
  </template>
  
  <script setup lang="ts">
  const route = useRoute()
  // const config = useRuntimeConfig()
  // console.log(config.public.apiBaseURL)
  const pageTitle = `Post No. ${route.params.id}`
  
  
  const { data: post } = await useMyFetch<any>(
    `post/${route.params.id}`,
    {}
  )
  console.log(post)
  
  
  </script>