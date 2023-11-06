<template>

  <div class="text-center " style=" background-image: url(/images/star.gif);">
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
        <form @submit.prevent="onReport()">
            <button class="block bg-red-900 hover:shadow-lg font-semibold text-white px-6 py-2 ">Report</button>
            <button class="block bg-red-900 hover:shadow-lg font-semibold text-white px-6 py-2 hidden">Reported</button>
        </form>
    </div>
    <div class="comment-section">
      <ul>
        <li v-for="(comment) in comments.data" :key="comment.id">
          <div>
            <img :src="imageURL(comment.profile_image)" class="rounded-full h-12 w-12 mb-4">{{ comment.user_name }} : 
            <textarea readonly v-model="comment.text"></textarea>
          </div>
        </li>
      </ul>
      <div class="pagination">
        <button class="pagination-button" @click="prevPage" :disabled="comments.meta.current_page === 1">Previous</button>
        <button class="pagination-button" @click="nextPage" :disabled="comments.meta.current_page === comments.meta.last_page">Next</button>
        Page: {{ comments.meta.current_page }} / {{ Math.ceil(comments.meta.total / comments.meta.per_page) === 0 ? 1 :  Math.ceil(comments.meta.total / comments.meta.per_page)}}
      </div>
    </div>

    <form @submit.prevent="onComment()">
      <textarea  type="text" id="comment_text" cols="30" rows="10"></textarea>
      <button class="action-button add-comment">Add Comment</button>
    </form>

            


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

  
    const response = await useMyFetch<any>(`likeStatus/post/${route.params.id}`,{});
    console.log(response.data.value.success);


    // console.log(likes);
    // const lengthAsNumber = parseInt(like.length, 10);
  


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
const {data: likes, error} = await useMyFetch<any>(`like/post/${route.params.id}`,{});
    if (likes.value !== null) {
      // console.log(error)
    } else { 
      // console.log(error)

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

const formData = ref({
    text: "",
    id: route.params.id,
    user: auth.user.id,
    page: 0
  })


  const {data: comments} = await useMyFetch<any>(`/comments/post/${route.params.id}`,{
      method: "POST",
      body: formData
    });
    if (comments.value !== null) {
      console.log(comments.value);
      console.log(comments.value.meta);
    } else { 
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

<style scoped>
.post-container {
  margin: 20px;
  padding: 20px;
  border: 1px solid #ccc;
  background-color: #fff;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.text-3xl {
  font-size: 24px;
  margin: 0 4px;
}

.rounded-full {
  border-radius: 50%;
}

.action-button {
  background-color: #ff0000;
  color: #fff;
  font-weight: bold;
  padding: 6px 12px;
  margin: 4px;
  border: none;
  cursor: pointer;
  border-radius: 4px;
  transition: background-color 0.3s;
}

.action-button:hover {
  background-color: #ff6666;
}

.liked {
  /* Add styles for the "Liked" button when it's hidden */
  display: none;
}

.reported {
  /* Add styles for the "Reported" button when it's hidden */
  display: none;
}

.comment-section {
  margin: 20px 0;
}

.pagination {
  margin-top: 20px;
  text-align: center;
}

.pagination-button {
  background-color: #ff0000;
  color: #fff;
  font-weight: bold;
  padding: 6px 12px;
  margin: 4px;
  border: none;
  cursor: pointer;
  border-radius: 4px;
  transition: background-color 0.3s;
}

.pagination-button:disabled {
  background-color: #ccc;
  cursor: not-allowed;
}

.pagination-button:hover {
  background-color: #ff6666;
}

.add-comment {
  background-color: #ff0000;
  color: #fff;
  font-weight: bold;
  padding: 6px 12px;
  border: none;
  cursor: pointer;
  border-radius: 4px;
  transition: background-color 0.3s;
}

.add-comment:hover {
  background-color: #ff6666;
}

ul {
    list-style: none;
  }

  /* Style for each comment item */
  li {
    margin-bottom: 20px;
    border: 1px solid #ddd;
    padding: 10px;
  }

  /* Style for the profile image */
  img.rounded-full {
    border-radius: 50%;
    height: 5rem;
    width: 5rem;
    margin-bottom: 1rem;
  }

  /* Style for the user name */
  .user-name {
    font-weight: bold;
  }

  /* Style for the input field */
  input[type="text"] {
    width: 500px;
    border: 1px solid #ccc;
    padding: 5px;
    border-radius: 5px;
    overflow: auto;
  }
  textarea {
    width: 500px;
    height: 100px; /* You can adjust the height as needed */
    border: 1px solid #ccc;
    padding: 5px;
    border-radius: 5px;
    resize: none;
    overflow: auto; /* Add scrollbar when content overflows */
  }
</style>