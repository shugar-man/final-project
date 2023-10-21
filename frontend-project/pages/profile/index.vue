<template>
    <div class="w-24 rounded-full">
        <img :src="test" alt="">
        <img :src="picPath" alt="">
        <img :src="require(`~/../backend-project/storage/app/public/${auth.user.profile_image}`)" alt="">
        {{ auth.user.profile_image }}
        {{ picPath }}
        <img :src=auth.user.profile_image v-if="auth.user.profile_image !== null">
        <img src="~/assets/img/cat.jpg" v-else >  <!--  <div>/img_default/</div> -->
        <!-- <img src="/images/users/miku-3.jpg" alt=""> -->
        <h1>====</h1>
        <img src="~/../backend-project/storage/app/public/miku-3.jpg" alt="">
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
const picPath = "~/../backend-project/storage/app/public/"+auth.user.profile_image
const test = "~/../backend-project/storage/app/public/miku-3.jpg"
console.log(picPath);

const { data: posts } = await useMyFetch<any>('post',{})

</script>