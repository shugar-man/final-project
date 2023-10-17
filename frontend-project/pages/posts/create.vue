<template>
    <h1 class="text-3xl">Creat Post</h1>
    <form @submit.prevent="onSubmit()">
      <div>
        <label for="name">Post Name</label>
        <p v-if="errorMessage" class="text-red-500">{{ errorMessage }}</p>
        <input v-model="name" type="text" id="name" >
        


      </div>
      <div>
        <label for="detail">Post Details</label>
        <p v-if="errorMessage" class="text-red-500">{{ errorMessage }}</p>
        <input v-model="detail" type="text" placeholder="Enter Detail" >

      </div>


      <div>
        <label for="image_path">Post Image</label>
        <p v-if="errorMessage" class="text-red-500">{{ errorMessage }}</p>
        <!-- <input v-model.trim="formData.image_path" type="file" id="image_path" name="image_path" /> -->
        <div>
    <input
      type="file"
      id="image_path"
      name="image_path"
      @change="handleImageUpload"
    />
  </div>
      </div>
  
      <div>
        <button type="submit" class ="colur:blue">
          Submit
        </button>
      </div>
    </form>
  </template>
  
  <script setup lang="ts">
  import { Body } from 'nuxt/dist/head/runtime/components';
import { useAuthStore } from '~/stores/useAuthStore';
  

  const auth = useAuthStore() 
  console.log(auth.user.name);
  const image_path = ref<File | null>(null);
  const detail = ref('');
  const username = ref(auth.user.name)
  const name = ref('');
  
  // const formData = ref({
  //   name: "",
  //   detail:'',
  //   user_name:auth.user.name,
  //   image_path:File
  // })
  const errorMessage = ref("")

  const handleImageUpload = (event: Event) => {
  const [_image_path] = (event.target as HTMLInputElement).files as FileList;

  image_path.value = _image_path;
};
// const { name ,user_name ,detail,image_path } = formData.value

  const onSubmit = async () => {
    try {
      if (!image_path.value) return;
      const body = new FormData();
      body.append('image_path', image_path.value, image_path.value.name);
      body.append('detail',detail.value)
      body.append('name',name.value)
      body.append('username',username.value)
      const { data: response, error } = await useMyFetch<any>("post", {
      method: "POST",
      body
    });
    if (response.value !== null) {
      errorMessage.value = ""
      await navigateTo(`/posts/${response.value.id}`)
      alert('Upload')
    } else { 
      console.log(error)
      const { statusMessage, data } = error.value!
      errorMessage.value = data.message
    }

    
  } catch (err) {
    console.log(err)
    alert('Error')
  }
  console.log(auth.user.name);
    
    

    
  
    // const { data: response, error } = await useMyFetch<any>("post", {
    //   method: "POST",
    //   body:formData
    // })
  
    // if (response.value !== null) {
    //   errorMessage.value = ""
    //   await navigateTo(`/posts/${response.value.id}`)
    // } else { 
    //   console.log(error)
    //   const { statusMessage, data } = error.value!
    //   errorMessage.value = data.message
    // }
    
  
    
  };
  </script>