<template>
  <div class="centered-block">
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
        <img id="previewImg" class="img-fluid rounded resized-image" src="/images/users/picture.png">
        <!-- <input v-model.trim="formData.image_path" type="file" id="image_path" name="image_path" /> -->
        <div>
    <input
      type="file"
      id="image_path"
      name="image_path"
      @change="handleImageUpload"
      accept="image/*"
    />
  </div>
      </div>
  
      <div class="">
        <button type="submit" class ="colur:blue focus:outline-black text-white text-sm py-2.5 px-4 border-b-4 border-blue-600 bg-blue-500 hover:bg-blue-400">
          Submit
        </button>
      </div>
    </form>

  </div>
    
  </template>
  
  <style>
  .resized-image {
    width: 400px;
    height: 300px;
    object-fit: contain;
  }
  .centered-block {
    position: relative;
    top: 45%;
    left: 50%;
    transform: translate(-50%, -50%);
  
  }
</style>

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
  
  const fileInput = document.getElementById("image_path") as HTMLInputElement;
  const previewImage = document.getElementById("previewImg") as HTMLImageElement;
  const selectedFile = fileInput.files?.[0];


  if (selectedFile) {
  // Create a URL for the selected file and set it as the image source
  const imageUrl = URL.createObjectURL(selectedFile);
  previewImage.src = imageUrl;
} else {
  // If no file is selected, clear the image source
  previewImage.src = "/images/users/picture.png";
}
  
};



// const { name ,user_name ,detail,image_path } = formData.value

  const onSubmit = async () => {
    try {
      if (!image_path.value) return alert("plase insert post image");
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
      alert('Upload')
      await navigateTo(`/posts/${response.value.id}`)
    } else { 
      console.log(error)
      const { statusMessage, data } = error.value!
      errorMessage.value = data.message
      console.log(errorMessage);
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