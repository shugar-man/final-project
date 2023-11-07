<template>
    <div class = "bg-gray-900 text-gray-100 py-3.5 px-6 shadow md:flex justify-between item-center">
      <div class="flex item-center cursor-pointer">
        <span>
          <DropDownMenu></DropDownMenu>
        </span>
        <span class="ml-4"> 
          <Logo></Logo>
        </span>
      </div>
      <div class="flex">
        <input v-model="topic" type="text" class="text-black" aria-invalid="false" placeholder="Search Tag" autocomplete="off" aria-label="Search"
       style="writing-mode: horizontal-tb !important;padding-block: 1px; padding-inline: 2px;">
       <form @submit.prevent="onSubmit()">
        <button type="submit" class ="w-full rounded-full bg-red-900 hover:shadow-lg font-semibold text-white px-6 py-2">
          search
        </button>
      </form>

      </div>
  
       
      <ul class="md:flex md:items-center">
        <a href="/" class="text-xl px-2 py-2 mx-2 my-2 bg-green-400 text-gray-800 rounded-md hover:bg-green-300">Home</a>
        <!-- <MenuLink to="/shop">Shop</MenuLink> -->
        <MenuLink to="/posts/create" v-if="auth.isLogin && !auth.isAdmin">Post</MenuLink>
        <MenuLink to="/admin" v-if="auth.isAdmin">Admin</MenuLink> <!-- v-if="auth.isAdmin" -->
        <DropDownProfile></DropDownProfile>
        
      </ul>
    </div>
</template>

<script setup lang="ts">
import { useAuthStore } from '~/stores/useAuthStore';
const auth = useAuthStore() 
const topic = ref('');

const onSubmit= async () => {
    const route = useRoute()
    
    // const {data: response,error} = await useMyFetch<any>(`/topic/tag/{topic}${route.params.id}`,{
    
    // const response = await axios.post(`/like/post/${route.params.id}`, body);

      await navigateTo(`/tag/${topic.value}`)
    
}
</script>

