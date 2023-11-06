<template>
  <div class="" style="background-image: url(/images/561525.jpg);display: block;
  margin-left: auto;
  margin-right: auto;
  width: 100%; height: 100%; object-fit: cover;">
  <div class="bg-black block mx-auto w-2/3">
    <div class="opacity-0">a</div>
    <div class="opacity-0">a</div>
    
    <h1 class="text-3xl w-1/2 bg-red-500 text-white text-center block mx-auto rounded-full">Creat Post</h1>
    <div class="opacity-0">a</div>
    <form @submit.prevent="onSubmit()">
      <div>
        <label for="name" class="text-center w-1/2 block mx-auto rounded-full text-white bg-black">Post Name</label>
        <input v-model="name" type="text" id="name"  placeholder="Enter Name"
        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 w-1/2 block mx-auto rounded-full">
        <p v-if="errorMessage" class="text-center w-1/4 block mx-auto rounded-full text-red-600 bg-black">{{ errorMessage }}</p>
      </div>
      <div class="opacity-0">a</div>
      <div>
        <label for="name" class="text-center w-1/2 block mx-auto rounded-full text-white">Tag</label>
        <!-- <input v-model="topic" type="text" id="tags" name="tags" placeholder="E.g.: ghost, painting, fanart, aipainting"
         class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 w-1/2 block mx-auto rounded-full">
         -->

         
        <form @submit.prevent="addInput()">
        <div class="">
        <input v-model="tag" type="text" id="tags" name="tags" placeholder="E.g.: ghost, painting, fanart, aipainting"
         class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 w-1/2 block mx-auto rounded-full ">
        <button class="w-1/2 block mx-auto rounded-full bg-red-900 hover:shadow-lg font-semibold text-white px-6 py-2">Add Tag</button>
        <div class="w-auto flex gap-2 justify-start">
          <div v-for="(input, index) in tags" :key="index" class=" bg-red-500 text-white text-center block mx-1 rounded-full " style="width: fit-content; padding: 4px; margin-left: 12px;"> 
           {{ input }}
        </div>

        </div>
        

  </div>
</form>

      </div>
      <div class="opacity-0">a</div>
      <div>
        <label for="detail" class="text-center w-1/2 block mx-auto rounded-full text-white">Post Details</label>
        <input v-model="detail" type="text" placeholder="Enter Detail" 
        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 w-1/2 block mx-auto rounded-full">

      </div>
      <div class="opacity-0">a</div>
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
      class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 w-1/2 block mx-auto rounded-full text-white"
      accept="image/*"
    />
    <p v-if="errorFileMessage" class="text-center w-1/4 block mx-auto rounded-full text-red-500 bg-black">{{ errorFileMessage }}</p>
  </div>
  </div>
  <div class="opacity-0">a</div>
      <div>
        <button type="submit" class ="w-1/2 block mx-auto rounded-full bg-red-900 hover:shadow-lg font-semibold text-white px-6 py-2">
          Submit
        </button>
        <div class="opacity-0">a</div>
        <div class="opacity-0">a</div>
      </div>


    </form>

  </div>
    

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

const tag = ref("");
const tags = ref<string[]>([]);

const addInput = async () => {
  if (tag.value.trim() !== '') {
    tags.value.push(tag.value);
    tag.value = ''; // Clear the input field
    console.log(tags.value);
  }
};
  

  const auth = useAuthStore() 
  // console.log(auth.user.name);
  const image_path = ref<File | null>(null);
  const detail = ref('');
  // const topic = ref('');
  const username = ref(auth.name)
  const name = ref('');
  
  // const formData = ref({
  //   name: "",
  //   detail:'',
  //   user_name:auth.user.name,
  //   image_path:File
  // })
  const errorMessage = ref("")
  const errorFileMessage = ref("")

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
      if (!image_path.value) {
        errorFileMessage.value = "post require image";
        return;
        
      } 
      errorFileMessage.value = "";  
      body.append('image_path', image_path.value, image_path.value.name);
      body.append('detail',detail.value)
      body.append('name',name.value)
      body.append('username',username.value)
      // body.append('topic',topic.value)
      for (const topicItem of tags.value) {
            body.append('topic[]', topicItem);
      }
      console.log(body.getAll('name'));
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
      alert(errorMessage)
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

<style scoped>
.dynamic-div {
  margin-top: 10px;
  padding: 10px;
  background-color: #f0f0f0;
}
</style>