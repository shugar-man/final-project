<template>

  <div class="text-center " style=" background-image: url(/images/bg.gif);">
    <div v-if="post" class="text-3xl mx-1 inline-block bg-red-500 " style="width: 50%;" >
      <div class="w-auto flex " >

      </div>
    <nuxt-link :to="`/page/${post.data.user_id}` " >
        
          <img style="display: block; margin: auto;" class="rounded-full h-12 w-12 mb-4 " :src=imageURL(post.data.user_profile_image)>
          {{ post.data.user_name }}
    </nuxt-link>

    <div class="w-auto flex gap-2 justify-center" >
      <div class="text-white">Art Name: </div>
      <div class="text-center">{{ post.data.name }}</div>

    </div>
          
          <img class="mx-auto w-92 h-92 relative border-4 border-white " style="display: block; width: 100%;" :src="imageURL(post.data.image_path)" >

    <div class="w-auto flex gap-2" > 
      <div class="text-white">detail: </div>
      <div class="text-center">{{ post.data.detail }}
      </div>


    </div>      
    
    <div class="w-auto flex gap-2" > 
      <div class="text-white">tag: </div>
      <div v-for="topic in topics.data" :key="topic.id">
      <div class="text-black bg-gray-400 text-center block mx-auto rounded-full" style="width: fit-content; padding: 4px;">{{topic.topic}}</div>
      </div>
        </div>
          
        <form @submit.prevent="onSubmit()">
            <button v-if="response.data.value.success==false" class="w-1/2 block mx-auto rounded-full bg-red-900 hover:shadow-lg font-semibold text-white px-6 py-2 ">
              <div>{{ likes.length }}</div>
     <svg class="block mx-auto" width="20px" height="20px" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M11 0h1v3l3 7v8a2 2 0 0 1-2 2H5c-1.1 0-2.31-.84-2.7-1.88L0 12v-2a2 2 0 0 1 2-2h7V2a2 2 0 0 1 2-2zm6 10h3v10h-3V10z"/></svg>

            </button>
        </form>
        <form @submit.prevent="unlike()">
          <button v-if="response.data.value.success==true" class="w-1/2 block mx-auto rounded-full bg-red-900 hover:shadow-lg font-semibold text-white px-6 py-2">
            <div>{{ likes.length }}</div>
            <svg class="block mx-auto" width="20px" height="20px" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M11 20a2 2 0 0 1-2-2v-6H2a2 2 0 0 1-2-2V8l2.3-6.12A3.11 3.11 0 0 1 5 0h8a2 2 0 0 1 2 2v8l-3 7v3h-1zm6-10V0h3v10h-3z"/></svg>
          </button>
        </form>
        <div class="opacity-0">a</div>
    <div class="opacity-0">a</div>

    </div>

            


          </div>
  </template>
  
  <script setup lang="ts">
  import axios from 'axios';
  import {useCounterStore} from '~/stores/useCounterStore'
  import { useAuthStore } from '~/stores/useAuthStore'
  const auth = useAuthStore()
  const counter = useCounterStore()
  const route = useRoute()
  const showbutton= false;
  console.log(auth.id)
  const pageTitle = `Post No. ${route.params.id}`
  
  
  const { data: post } = await useMyFetch<any>(
    `post/${route.params.id}`,
    {}
  )
  const { data: topics } = await useMyFetch<any>(
    `topic/${route.params.id}`,
    {}
  )
  function imageURL(path:string) {
  return import.meta.env.VITE_BACKEND_IMG_URL + '/' + path
  }

  // console.log(post)
  const body = new FormData();
  const name = ref("");

  const {data: likes, error} = await useMyFetch<any>(`like/post/${route.params.id}`,{});
    if (likes.value !== null) {
      // console.log(error)
    } else { 
      // console.log(error)

    }
    const response = await useMyFetch<any>(`likeStatus/post/${route.params.id}`,{});
    console.log(response.data.value.success);


    // console.log(likes);
    // const lengthAsNumber = parseInt(like.length, 10);
    counter.setcounter(likes.value.length);
  


  const onSubmit= async () => {
    body.append('name',name.value);
    const route = useRoute()
    
    // const response = await axios.post(`/like/post/${route.params.id}`, body);
    const {data: response,error} = await useMyFetch<any>(`like/post/${route.params.id}`,{
      method: "POST",
      body
    });
    if (response.value.message=="Unauthorized") {
      await navigateTo('/login')
    }
    else {
      alert('like complete')
    }
}
const unlike= async () => {
    const {data: response,error} = await useMyFetch<any>(`unlike/post/${route.params.id}`,{});
    console.log(error.value?.data.message)
    if (response.value.message=="Unauthorized") {
      await navigateTo('/login')
    }
    else {
      alert('unlike')
    }
}
  
  
  </script>