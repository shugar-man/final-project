<template>
          <div class="bg-white grid md:grid-cols-5 gap-10 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 w-1/2 block mx-auto rounded-full">
            <div class="bg-red-500 w-1/3 px-1 rounded-full">Tag: </div>
            <nuxt-link :to="`/tag/painting`" class="text-gray-800 hover:bg-green-300">Painting</nuxt-link>
            <nuxt-link :to="`/tag/aipaint`" class="text-gray-800 hover:bg-green-300">Ai Painting</nuxt-link>
            <nuxt-link :to="`/tag/anime`" class="text-gray-800 hover:bg-green-300">Anime</nuxt-link>
            <nuxt-link :to="`/tag/fanart`" class="text-gray-800 hover:bg-green-300">Fanart</nuxt-link>
          </div>
          <div class="h-full" style="background-image: url(/images/star.gif);">
            <div class="grid md:grid-cols-4 gap-10 " style=" width: 100%; height: auto; object-fit: cover;">

          <div v-if="posts.data!==null" v-for="post in posts.data" :key="post.id">
          <div class=" hover:bg-gray-100 hover:text-white transition duration-300 max-w-sm rounded overflow-hidden shadow-lg" style="background-color: rgb(199, 109, 109);">
          <div class="py-12 px-8">
      
          <div class="" style="width: auto; height: 100%; position: relative; contain-intrinsic-size: 1369px 282.955px; content-visibility: auto;">
      
      <!-- <img style="width: 168px; height: 100%; display: inline-block; float: left; position: relative; margin: 4px;" :src=imageURL(post.user_profile_image)> -->
      <nuxt-link :to="`/page/${post.user_id}`">
      {{ post.user_name }}
        <img style="" class="rounded-full h-12 w-12 mb-4" :src=imageURL(post.user_profile_image)>
      </nuxt-link>
      
      <div class="grid grid-cols-2 gap-10">
        <nuxt-link :to="`/posts/${post.id}`">
          {{ post.name }}
          <img class="inline-block h-60 w-100% mb-4" :src="imageURL(post.image_path)" >
          <!-- <img class="w-auto relative border-4 border-white " :src="imageURL(post.image_path)" > -->
        </nuxt-link>

        
        
      
      </div>   
      </div>
    </div>

    
  </div>
</div>
</div>

</div>
  

</template>
<script setup lang="ts">
  import {useCounterStore} from '~/stores/useCounterStore'
  import { useAuthStore } from '~/stores/useAuthStore'
  const auth = useAuthStore()
  const counter = useCounterStore()

  function imageURL(path:string) {
  return import.meta.env.VITE_BACKEND_IMG_URL + '/' + path
  }
const route = useRoute()
console.log(`like/post/${route.params.name}`)
const {data: posts, error} = await useMyFetch<any>(`topic/tag/${route.params.name}`,{});
if (posts == null) {
    console.log("dasdaa")
}
console.log(posts.value)
</script>
