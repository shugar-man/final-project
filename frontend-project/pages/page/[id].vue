<template>
  <!-- <div>
    <div :style="{ backgroundImage: 'url(' + imageURL(user.profile_image) + ')', width: '100%', height: '400px', backgroundSize: 'cover' }">
      <div class="container bg-red-500 mx-auto" style="
      margin-top: 50px;
      display: flex;
      align-items: flex-end;" >
        {{ user.username }}</div>
       <div class="" style="width: auto; height: 5000px;">
       </div>
  <div>
  </div>
</div>
</div> -->
<div
    >
    <div class="rounded-t-lg h-100 overflow-hidden">
        <img class="object-cover object-top w-full h-full" style="height: 300px;" :src=imageURL(user.profile_image)>
    </div>
    <div class="mx-auto w-32 h-32 relative -mt-16 border-4 border-white rounded-full overflow-hidden">
        <img :src=imageURL(user.profile_image)>
    </div>
    <div class="text-center mt-2">
        <!-- <p class="text-gray-500">Freelance Web Designer</p> -->
    </div>
    <ul class="py-4 mt-2 text-gray-700 flex items-center justify-around ">
        <li class="flex flex-col items-center justify-around">
          <svg class="w-4 fill-current text-blue-900" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">  
                <path
                    d="M7 8a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0 1c2.15 0 4.2.4 6.1 1.09L12 16h-1.25L10 20H4l-.75-4H2L.9 10.09A17.93 17.93 0 0 1 7 9zm8.31.17c1.32.18 2.59.48 3.8.92L18 16h-1.25L16 20h-3.96l.37-2h1.25l1.65-8.83zM13 0a4 4 0 1 1-1.33 7.76 5.96 5.96 0 0 0 0-7.52C12.1.1 12.53 0 13 0z" />
                    </svg>
                    <div>{{ follow.data.value.length }}</div>
        </li>

        
        <li class="flex flex-col items-center justify-between">
          <div class="rounded-full bg-red-300 w-500">{{ user.name }}</div>
            
        </li>
        <li class="flex flex-col items-center justify-around">
        <svg width="20px" height="20px" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>

        </li>
    </ul>
    

    


    <div class="p-4 border-t mt-2  bg-red-300">
        <form @submit.prevent="onSubmit()">
            <button v-if="like.data.value.success==false" class="w-1/2 block mx-auto rounded-full bg-gray-900 hover:shadow-lg font-semibold text-white px-6 py-2" >Follow</button>
        </form>
        <form @submit.prevent="unSub()">
          <button v-if="like.data.value.success==true" class="w-1/2 block mx-auto rounded-full bg-gray-900 hover:shadow-lg font-semibold text-white px-6 py-2">Followed</button>
        </form>
            

        
    </div>
    <button @click="suspendUser" class="bg-red-500 text-white rounded px-4 py-2 hover:bg-red-700">
        Suspend
    </button>
    
</div>
  
       
<div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2 gap-10 bg-black">
    <div class="relative " v-for="post in posts" :key="post.id">
                <nuxt-link :to="`/posts/${post.id}`">
                    <img class="mx-auto w-92 h-92 relative border-4 border-white "
                    :src="imageURL(post.image_path)"
                        alt="Sunset in the mountains">
                    <div
                        class="hover:bg-white transition duration-300 absolute bottom-0 top-0 right-0 left-0 bg-red-100 opacity-25">
                    </div>
                </nuxt-link>
                <div class="px-6 py-4">

                <div
                    class="font-semibold text-lg inline-block hover:text-indigo-600 transition duration-500 ease-in-out text-white">{{ post.name }}</div>
                <p class="text-gray-300 text-sm">
                    {{ user.name }}
                </p>
            </div>
            </div>
        </div> 
</template>

<script setup lang="ts">
const route = useRoute()
// const config = useRuntimeConfig()
// console.log(config.public.apiBaseURL)
const pageTitle = `User Name. ${route.params.id}`


const { data: user } = await useMyFetch<any>(
  `/page/${route.params.id}`,
  {}
)
// const { data: posts} = await useMyFetch<any>("/", {})
  const { data: posts} = await useMyFetch<any>(
  `/page/${route.params.id}/post`,
  {}
)
function imageURL(path:string) {
  return import.meta.env.VITE_BACKEND_IMG_URL + '/' + path
  }

// console.log(posts)
// console.log(user)
const like = await useMyFetch<any>(`/page/sub/${route.params.id}`,{});
if (like.data.value.success==true) {
  console.log(!like.data.value.success);
}

const onSubmit= async () => {
    const route = useRoute()
    const {data: response, error} = await useMyFetch<any>(`/page/subscribe/${route.params.id}`,{
      method: "POST"
    });
    if  (response.value.message=="Unauthorized") {
      await navigateTo('/login')

    }
    else { 
      alert('follow')

    }
}
const unSub= async () => {
    const route = useRoute()
    const {data: response, error} = await useMyFetch<any>(`/page/unfollow/${route.params.id}`,{});
    if  (response.value.message=="Unauthorized") {
      await navigateTo('/login')
    }
    else { 
      alert('unfollow')

    }
}

const follow = await useMyFetch<any>(`/page/subscribe/${route.params.id}`,{});
console.log(follow.data.value.length);


async function suspendUser() {
  try {
    console.log('User ID to suspend:', user.value.id);
    const response = await useMyFetch<any>(`/admin/suspend-user/${user.value.id}`, {
      method: 'POST',
    });

    if (parseInt(response.status.value) === 200) {

      console.log('User suspended successfully');
    } else {

      console.error('Failed to suspend the user');
    }
  } catch (error) {

    console.error('Network or request error:', error);
  }
}



</script>