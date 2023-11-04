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
        <div class="flex ">
          <form @submit.prevent="onSubmit()">
            <button class="block bg-red-900 hover:bg-red-400 font-semibold text-white px-6 py-2 ">Like</button>
            <button class="block bg-red-900 hover:bg-red-400  font-semibold text-white px-6 py-2 hidden">Liked</button>
        </form>
        <form @submit.prevent="onReport()">
            <button class="block bg-red-900 hover:bg-red-400  font-semibold text-white px-6 py-2 ">Report</button>
            <button class="block bg-red-900 hover:bg-red-400  font-semibold text-white px-6 py-2 hidden">Reported</button>
        </form>
        </div>
    </div>

        <div v-for="comment in comments" :key="comment.id">
          
          <span class="relative" style="list-style-type: none;" >
             {{ comment.text }}
          </span>  
        </div>
         
    

            <form @submit.prevent="onComment()">

              <input type="text" id="comment_text">
              <button class="block bg-red-900 hover:shadow-lg font-semibold text-white px-6 py-2 ">Add Comment</button>
            </form>
            <span v-if="false">{{ post.data.id }}</span>
  
  </template>
  
  <script setup lang="ts">
  import axios from 'axios';
  import { useAuthStore } from '~/stores/useAuthStore';
  
  const auth = useAuthStore()
  const route = useRoute()
  // const config = useRuntimeConfig()
  // console.log(config.public.apiBaseURL)
  const pageTitle = `Post No. ${route.params.id}`
  
  
  const { data: post } = await useMyFetch<any>(
    `post/${route.params.id}`,
    {}
  )
  const errorMessage = ref("")
  function imageURL(path:string) {
  return import.meta.env.VITE_BACKEND_IMG_URL + '/' + path
  }
  console.log(post)
  const body = new FormData();
  const name = ref("");
  
  const formData = ref({
    text: "",
    id: route.params.id,
    user: auth.user.id
  })

  const {data: comments, errors} = await useMyFetch<any>(`/comments/post/${route.params.id}`,{
      method: "POST",
      body: formData
    });
    if (comments.value !== null) {
      console.log(comments.value);
      
      
    } else { 
      console.log(errors)
    }


    
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
    body.append('name',name.value);
    const route = useRoute()
    const {data: response, error} = await useMyFetch<any>(`reportPost/post/${route.params.id}`,{
      method: "POST",
      body
    });
    if (response.value !== null) {
      alert('Upload')
    } else { 
      console.log(error)

    }
}

const onComment = async () => {
    const route = useRoute()
    const com_text = document.getElementById("comment_text") as HTMLInputElement
    
    formData.value.text = com_text.value
    console.log(formData.value);
    
    const {data: response, error} = await useMyFetch<any>("/comments",{
      method: "POST",
      body: formData
    });
    if (response.value !== null) {
      alert('Commentted')
    } else { 
      console.log(error)
      alert("please input comment")
    }
    console.log(response.value);
  
}
  
  
  </script>