<template>
  <div style="padding-inline-start: 40px;margin-block-end: 1em;margin-block-start: 1em;list-style-type: disc;background-color: #042f55; background-image: url(/images/bg.gif); background-repeat: repeat-x; display: block;">
    <h2 class="text-2xl font-semibold mb-4">Reported Posts</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2 gap-10">
      <div v-for="post in reportedPosts" :key="post.id" class="mb-4 p-4 bg-white rounded shadow-md">
        <div class="hover:bg-gray-900 hover:text-white transition duration-300 max-w-sm rounded overflow-hidden shadow-lg">
          <div class="py-4 px-8">
        
            <div class="" style="width: 1369px; contain-intrinsic-size: 1369px 282.955px; content-visibility: auto;">
              <div class="flex items-center mb-2">
                <nuxt-link :to="`/page/${post.user_id}`" class="flex items-center">
                  <img :src="imageURL(post.user_profile_image)" class="rounded-full h-12 w-12 mr-2" />
                  <span class="text-lg font-semibold">{{ post.user_name }}</span>
                </nuxt-link>
              </div>
              <div>
                <nuxt-link :to="`/posts/${post.id}`" class="flex items-center">
                  <img :src="imageURL(post.post_image_path)" class="w-24 h-24 object-cover mr-2" />
                  <span class="text-lg font-semibold">{{ post.post_name }}</span>
                </nuxt-link>
              </div>
              <button @click="deletePost(post)" class="mt-2 bg-red-500 text-white rounded px-4 py-2 hover:bg-red-700">
                Delete
              </button>
            
            <div v-if="reportedPosts.length === 0" class="text-lg text-gray-600 mt-4">
              No reported posts
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</template>

<script setup lang="ts">
const route = useRoute();
const { data: reportedPosts, pending } = await useMyFetch<any>('/admin/reported-posts', {});


function imageURL(path: string) {
  return import.meta.env.VITE_BACKEND_IMG_URL + '/' + path;
}

const deletePost = async (post: { id: number }) => {
  console.log('post.id:', post.id);
  if (typeof post.id === 'number') {
    try {
      const response = await useMyFetch<any>(`/admin/delete-post/${post.id}`, {
        method: 'DELETE',
      });
      if (typeof response.status === 'number' && response.status === 200) {
        console.log('Success');
      } else {
        console.error('Failed to delete the post');
        console.error(response.status)
      }
    } catch (error) {
      console.error('Network or request error:', error);
    }
  } else {
    console.error('Invalid post:', post);
  }
};
</script>
