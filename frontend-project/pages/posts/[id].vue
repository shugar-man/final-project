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

        <div>
          <ul>
            <li v-for="(comment,index) in comments.data" :key="comment.id">
              <div>
                {{ comment.user_name }} : <input type="text" disabled v-model="comment.text" style="width: 500px;"> 
              </div>
            </li>
            
          </ul>
            <div> 
              <button class="bg-red-500 text-white px-4 py-2 rounded-lg" @click="prevPage" :disabled="comments.meta.current_page === 1">Previous</button>
              <button class="bg-red-500 text-white px-4 py-2 rounded-lg" @click="nextPage" :disabled="comments.meta.current_page === comments.meta.last_page">Next</button>
              page: {{ comments.meta.current_page }} / {{ comments.meta.total / comments.meta.per_page }}
            </div>
          </div>

            <form @submit.prevent="onComment()">

              <input type="text" id="comment_text" style="width: 500px;">
              <button class="block bg-red-900 hover:shadow-lg font-semibold text-white px-6 py-2 ">Add Comment</button>
            </form>
            <span v-if="false">{{ post.data.id }}</span>
  
  </template>
  
  <script setup lang="ts">
import axios from 'axios';
  import { useAuthStore } from '~/stores/useAuthStore';
  const auth = useAuthStore()
  const route = useRoute()
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
    user: auth.user.id,
    page: 0
  })


  const {data: comments, errors} = await useMyFetch<any>(`/comments/post/${route.params.id}`,{
      method: "POST",
      body: formData
    });
    if (comments.value !== null) {
      console.log(comments.value);
      console.log(comments.value.meta);
    } else { 
      console.log(errors)
    }
  
    const prevPage = () => {
  if (comments.value.meta.current_page > 1) {
    formData.value.page = comments.value.meta.current_page - 1;
    fetchData();
  }
};

const nextPage = () => {
  if (comments.value.meta.current_page < comments.value.meta.last_page) {
    formData.value.page = comments.value.meta.current_page + 1;
    fetchData();
  }
};

const fetchData = async () => {
  try {
    const { data: newComments, error } = await useMyFetch<any>(`/comments/post/${$route.params.id}`, {
      method: "POST",
      body: formData
    });

    if (error) {
      console.error('Error fetching data:', error);
      return;
    }

    // Update the comments with the new data
    comments.value = newComments;
  } catch (e) {
    console.error('An error occurred while fetching data:', e);
  }
};

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
      window.location.reload();
    } else { 
      console.log(error)
      alert("please input comment")
    }
    console.log(response.value);
  
}


  

  </script>


