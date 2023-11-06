<template>
  <div class="post-container">
    <div v-if="post" class="text-3xl mx-4">
      <nuxt-link :to="`/page/${post.data.user_id}`">
        {{ post.data.user_name }}
        <img class="rounded-full h-12 w-12 mb-4" :src="imageURL(post.data.user_profile_image)" />
      </nuxt-link>

      <nuxt-link :to="`/posts/${post.data.id}`">
        {{ post.data.name }}
        <img :src="imageURL(post.data.image_path)" />
      </nuxt-link>

      <div class="flex">
        <form @submit.prevent="onSubmit()">
          <button class="action-button like">Like</button>
          <button class="action-button liked hidden">Liked</button>
        </form>
        <form @submit.prevent="onReport()">
          <button class="action-button report">Report</button>
          <button class="action-button reported hidden">Reported</button>
        </form>
      </div>
    </div>

    <div class="comment-section">
      <ul>
        <li v-for="(comment) in comments.data" :key="comment.id">
          <div>
            <img :src="imageURL(comment.profile_image)" class="rounded-full h-12 w-12 mb-4">{{ comment.user_name }} : <input type="text" style="width: 500px;" disabled v-model="comment.text" />
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
      <input type="text" id="comment_text" style="width: 500px;" />
      <button class="action-button add-comment">Add Comment</button>
    </form>
    <span v-if="false">{{ post.data.id }}</span>
  </div>
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
      alert('Liked')
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
</style>