<template>

  
    <div v-if="post" class="text-3xl mx-4">
    <nuxt-link :to="`/page/${post.data.user_id}`">
        {{ post.data.user_name }}
          <img style="" class="rounded-full h-12 w-12 mb-4" :src=imageURL(post.data.user_profile_image)>
    </nuxt-link>
    
      
        <nuxt-link :to="`/posts/${post.data.id}`">
            {{ post.data.name }}
            <img :src="imageURL(post.data.image_path)" >
        </nuxt-link>
        <form @submit.prevent="onSubmit()">
            <button class="block bg-red-900 hover:shadow-lg font-semibold text-white px-6 py-2 ">Like</button>
            <button class="block bg-red-900 hover:shadow-lg font-semibold text-white px-6 py-2 hidden">Liked</button>
        </form>
        <form @submit.prevent="onReport()">
            <button class="block bg-red-900 hover:shadow-lg font-semibold text-white px-6 py-2 ">Report</button>
            <button class="block bg-red-900 hover:shadow-lg font-semibold text-white px-6 py-2 hidden">Reported</button>
        </form>
    </div>


    <!-- <div class="relative" v-for="post in posts" :key="post.id">
                <nuxt-link :to="`/posts/${post.id}`">
                    <img 
                    :src="imageURL(post.image_path)"
                        alt="Sunset in the mountains">
                    <div
                        class="hover:bg-transparent transition duration-300 absolute bottom-0 top-0 right-0 left-0 bg-gray-900 opacity-25">
                    </div>
                </nuxt-link>
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
            </div> -->
            <input v-model="name" type="text" id="name">
            <span v-if="false">{{ post.data.id }}</span>
  
  </template>
  
  <script setup lang="ts">
  import axios from 'axios';
  const route = useRoute()
  // const config = useRuntimeConfig()
  // console.log(config.public.apiBaseURL)
  const pageTitle = `Post No. ${route.params.id}`
  
  
  const { data: post } = await useMyFetch<any>(
    `post/${route.params.id}`,
    {}
  )

  function imageURL(path:string) {
  return import.meta.env.VITE_BACKEND_IMG_URL + '/' + path
  }
  console.log(post)
  const body = new FormData();
  const name = ref("");
  


  const onSubmit= async () => {
    body.append('name',name.value);
    const route = useRoute()
    const {data: response, error} = await useMyFetch<any>(`like/post/${route.params.id}`,{
      method: "POST",
      body
    });
    if (response.value !== null) {
      alert('Upload')
    } else { 
      console.log(error)

    }
}

const onReport= async () => {
    const route = useRoute()
    body.append('post_id', route.params.id.toString());
    const {data: response, error} = await useMyFetch<any>(`reportPost/post/${route.params.id}`,{
      method: "POST",
      body
    });
    if (response.value !== null) {
      console.log(response.value);
    } else {
      console.log(error);
    }
}
// const onReport = async () => {
//     body.append('post_id', post.data.id); 
//     const route = useRoute();
    
//     try {
//         const { data: response } = await axios.post(`/api/reportPost/post/${post.data.id}`, body);
//         if (response.message === 'Post reported successfully') {
//             alert('Post reported successfully');
//         } else {
//             console.log('Report failed');
//         }
//     } catch (error) {
//         console.error(error);
//     }
// }
  
  
</script>