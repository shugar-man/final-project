<template>
    <div class="w-24 rounded-full">
        
        <img :src=auth.user.profile_image v-if="auth.user.profile_image !== null">
        <img src="~/assets/img/cat.jpg" v-else > //img_default
        <div>
            {{ auth.user.name }}
            <div v-for="post in posts.posts" :key="post.id">
                <div class="text-xl mx-6 my-2">
                    {{ post.image }}
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { useAuthStore } from '~/stores/useAuthStore';
  
const auth = useAuthStore() 

const { data: posts } = await useMyFetch<any>('post',{})

</script>