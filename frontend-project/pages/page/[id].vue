<template>
  

  
  <div style="background-image: url('/images/users/download.png'); width: 100%; height: 400px; background-size: cover;">
      <h1 class="text-blue-600">wwww</h1>
      <div class="container bg-red-500 mx-auto" >
        {{ user.username }}</div>
       <div class="" style="width: auto; height: 5000px;">
       </div>
       
    </div>
    
    <div class="bg-yelllow-500 w-auto flex">
      <button  class="w-40 text-center">post</button>
      <button  class="w-40 text-center">gallery</button>   
      <div class="flex-grow bg-blue-400"></div>
      <div class="w-40 text-center">subscribe</div>
    </div>
    <div class="bg-red-500" style="padding-top: 10px; margin-left: 20%; margin-right: 20%;">
      <h1 class="asd">dsss</h1>
    </div>

      <div v-for="post in posts.data" :key="post.id">
      <div class="m-4 text-blue-600">
      <nuxt-link :to="`/posts/${post.id}`">
        {{ post.name }}
      </nuxt-link>
      <div></div>
  </div>
    </div>
    <div class="relative">
                <a href="#">
                    <img class="w-full"
                        src="https://images.pexels.com/photos/196667/pexels-photo-196667.jpeg?auto=compress&amp;cs=tinysrgb&amp;dpr=1&amp;w=500"
                        alt="Sunset in the mountains">
                    <div
                        class="hover:bg-transparent transition duration-300 absolute bottom-0 top-0 right-0 left-0 bg-gray-900 opacity-25">
                    </div>
                </a>
                <a href="#!">
                    <div
                        class="absolute bottom-0 left-0 bg-indigo-600 px-4 py-2 text-white text-sm hover:bg-white hover:text-indigo-600 transition duration-500 ease-in-out">
                        Photos
                    </div>
                </a>

                <a href="!#">
                    <div
                        class="text-sm absolute top-0 right-0 bg-indigo-600 px-4 text-white rounded-full h-16 w-16 flex flex-col items-center justify-center mt-3 mr-3 hover:bg-white hover:text-indigo-600 transition duration-500 ease-in-out">
                        <span class="font-bold">27</span>
                        <small>March</small>
                    </div>
                </a>
            </div>

  
  
</template>

<script setup lang="ts">
const route = useRoute()
// const config = useRuntimeConfig()
// console.log(config.public.apiBaseURL)
const pageTitle = `User Name. ${route.params.id}`


const { data: user } = await useMyFetch<any>(
  `/page/${route.params.id}`,
  {}
)
const { data: posts} = await useMyFetch<any>("/", {})




</script>