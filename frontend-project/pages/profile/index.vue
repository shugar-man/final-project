<template>
  <div class="flex items-center justify-center">
    <div class="profile-container">
      <div class="profile-content">
        <img :src=imageURL(auth.user.profile_image) class="profile-image" alt="Profile Picture">
        <h1 class="profile-name">{{ auth.user.name }}</h1>
        <div class="profile-details">
          <p>Email: {{ auth.user.email }}</p>
          <p>Artwork Total: {{ art_total }}</p>
          <p>Tel: {{ auth.user.tel }}</p>
        </div>
        <nuxt-link to="/profile/edit">
          <button class="edit-button">Edit Profile</button>
        </nuxt-link>
        <nuxt-link :to="`/page/${auth.user.id}`">
          <button class="view-button">View My Posts</button>
        </nuxt-link>
      </div>
    </div>
  </div>
</template>
  <script setup lang="ts">
  import { ref } from 'vue';
  import { useAuthStore } from '~/stores/useAuthStore';
  const route = useRoute()
  const auth = useAuthStore()
  const idUser = ref({
    id: auth.user.id
})
console.log(auth.user.profile_image);

  function imageURL(path:string) {
  return import.meta.env.VITE_BACKEND_IMG_URL + '/' + path
  }
  
  const { data: response, pending } = await useMyFetch<any>("/countPost", {
    method : "POST",
    body : idUser
  })
  const art_total = response.value;
  console.log(art_total);
  console.log(idUser.value.id);
  
  
  
  
  </script>

<style scoped>
.profile-container {
  background-color: #fff;
  width: 33.333%;
  margin-top: 10px;
  border-radius: 10px;
  padding: 1.5rem;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.profile-image {
  width: 8rem;
  height: 8rem;
  border-radius: 50%;
  object-fit: cover;
  margin-top: 1rem;
}

.profile-name {
  color: #333;
  font-weight: 600;
  font-size: 1.5rem;
  margin-top: 1rem;
}

.profile-details {
  color: #888;
  font-size: 0.875rem;
  text-align: center;
  margin-top: 0.5rem;
}

.edit-button,
.view-button {
  background-color: #3490dc;
  color: #fff;
  font-weight: 600;
  border: none;
  border-radius: 10px;
  padding: 0.5rem 1rem;
  margin-top: 1rem;
  cursor: pointer;
  transition: background-color 0.3s;
}

.edit-button:hover,
.view-button:hover {
  background-color: #2779bd;
}
</style>