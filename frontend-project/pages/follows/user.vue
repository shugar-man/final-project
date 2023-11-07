<template>
    <div style=" background-image: url(../images/bg.gif); width: 100%; height: 100%;">
        <div class="py-4 px-8 grid md:grid-cols-5 gap-10">
    <div v-for="user in users.data" :key="user.id">
        <div class="py-4 px-20" style=" background-color: brown; ">
        
        <!-- <img style="width: 168px; height: 100%; display: inline-block; float: left; position: relative; margin: 4px;" :src=imageURL(post.user_profile_image)> -->
        <div>
            <nuxt-link :to="`/page/${user.id}` " > <img style="" class="rounded-full h-12 w-12 mb-4 " :src=imageURL(user.profile_image)></nuxt-link>
           {{ user.name }}
        </div>
        </div>
    </div>
</div>

    </div>

        
        
</template>
<script setup lang="ts">
const { data: users } = await useMyFetch<any>("/follows/following", {});
console.log(users)
function imageURL(path:string) {
  return import.meta.env.VITE_BACKEND_IMG_URL + '/' + path
  }

</script>