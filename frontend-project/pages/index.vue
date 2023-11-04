<template>
  <div style="padding-inline-start: 40px;margin-block-end: 1em;margin-block-start: 1em;list-style-type: disc;background-color: #042f55; background-image: url(/images/bg.gif); background-repeat: repeat-x; display: block;">
  <h2 class="text-white">หน้าโพสต์</h2>
  <div class="text-white">{{ auth.user.name }}</div>

  <div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2 gap-10">
  <div v-for="post in posts.data" :key="post.id">
    <div class="hover:bg-gray-900 hover:text-white transition duration-300 max-w-sm rounded overflow-hidden shadow-lg">
      <div class="py-4 px-8">
        
        <div class="" style="width: 1369px; contain-intrinsic-size: 1369px 282.955px; content-visibility: auto;">
        
        <!-- <img style="width: 168px; height: 100%; display: inline-block; float: left; position: relative; margin: 4px;" :src=imageURL(post.user_profile_image)> -->
        <nuxt-link :to="`/page/${post.user_id}`">
        {{ post.user_name }}
          <img style="" class="rounded-full h-12 w-12 mb-4" :src=imageURL(post.user_profile_image)>
        </nuxt-link>
        
        <!-- <div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2 gap-10"> -->
          <nuxt-link :to="`/posts/${post.id}`">
            {{ post.name }}
            <img :src="imageURL(post.image_path)" >
          </nuxt-link>
          
          
        
        <!-- </div>    -->
        </div>
      </div>

    </div>
  </div>
</div>
</div>
  
  

</template>

<script setup lang="ts">
import { useAuthStore } from '~/stores/useAuthStore'
const auth = useAuthStore()
// const config = useRuntimeConfig()
// const { data: users, pending } = await useMyFetch<any>("/", {})
 // const { data: postser, pending } = await useFetch<any>("/post", {method: 'GET'})
const { data: posts, pending } = await useMyFetch<any>("/", {})




console.log(posts)
console.log(auth.user.name )

function imageURL(path:string) {
  return import.meta.env.VITE_BACKEND_IMG_URL + '/' + path
  }
  // body {
  //   font-family: "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", "メイリオ", Meiryo, Osaka, "ＭＳ Ｐゴシック", "MS PGothic", sans-serif;
  //   color: #003;
  //   font-size: 95%;
  //   background-color: #042f55;
  //   background-image: url(../images/bg.gif);
  //   background-repeat: repeat-x;
  //   background-attachment: fixed;
  //   background-position: top;
  //   line-height: normal;}
  // .round-body {
  //   padding: 0 10px;
  //   background-image: url(../images/main_bg2.png);
  //   background-repeat: repeat-y;
  //   background-position: left top;
//   ul {
//     display: block;
//     list-style-type: disc;
//     margin-block-start: 1em;
//     margin-block-end: 1em;
//     margin-inline-start: 0px;
//     margin-inline-end: 0px;
//     padding-inline-start: 40px;
// }
// style="padding-inline-start: 40px;margin-block-end: 1em;margin-block-start: 1em;list-style-type: disc;background-color: #042f55; background-image: url(/images/bg.gif); background-repeat: repeat-x; display: block;"

  
  </script>
  
  <style scoped>
  @keyframes colorChange {
    0% { color: rgba(255, 255, 255, 1); }
    50% { color: rgb(15, 243, 30); } 
    100% { color: rgba(255, 255, 255, 1); }
  }
  
  .animate-text-color {
    animation: colorChange 2s infinite; 
  }
</style>
