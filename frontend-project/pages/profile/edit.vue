<template>
    <div class="flex items-center justify-center">
      <div class="bg-white w-1/3 mt-10 rounded-lg p-6">
        <div class="flex items-center justify-center flex-col">
    
          
          <h1 class="text-gray-800 font-semibold text-xl mt-5">Name: {{ auth.user.name }}
            <li class="flex">New Name:</li> <input type="text" class="" value="`${{ auth.user.name }}`">
          </h1>
          
        <div>
          <img id="previewImg" class="rounded-full w-32" style="margin-left: 80px;" :src=imageURL(auth.user.profile_image)>
          <div>
      <input
      type="file"
      id="image_path"
      name="image_path"
      @change="handleImageUpload"
      accept="image/*"/>
          </div>
        </div>

          <div class="text-gray-400 text-sm mt-2">
            <p>Email: {{ auth.user.email }}</p>
            <p>Artwork Total: {{ art_total }}</p>
            <p>Like Total: {{ }}</p>
            <p>Tel: <input type="text" value="auth.user.tel"></p>
          </div>
          <form @submit.prevent="onSubmit()">
            <div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg px-4 py-2 mt-4">
                Submit
            </button>
        </div>
          </form>
        </div>
      </div>
    </div>

    
  </template>
  
  <script setup lang="ts">
  import { ref } from 'vue';
  import { useAuthStore } from '~/stores/useAuthStore';
  import { Body } from 'nuxt/dist/head/runtime/components';
  const image_path = ref<File | null>(null);
  const auth = useAuthStore()
  console.log(auth.user.profile_image);
  
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
  previewImage.src = imageURL(auth.user.profile_image);
}
  
};

  const idUser = ref({
    id: auth.user.id
})



  function imageURL(path:string) {
  return import.meta.env.VITE_BACKEND_IMG_URL + '/' + path
  }


  const onSubmit = async () => {
    try {
      if (!image_path.value) return alert("plase insert post image");
      const body = new FormData();
      body.append('image_path', image_path.value, image_path.value.name);
      body.append('name',name.value)
      body.append('username',username.value)
      const { data: response, error } = await useMyFetch<any>("/profile/edit", {
      method: "POST",
      body
    });
    if (response.value !== null) {
      errorMessage.value = ""
      alert('Update Profile')
      await navigateTo(`/posts/${response.value.id}`)
    } else { 
      const { statusMessage, data } = error.value!
      errorMessage.value = data.message
      console.log(errorMessage);
    }

    
  } catch (err) {
    console.log(err)
    alert('Error')
  }
}
  console.log(auth.user.name);

  const { data: response, pending } = await useMyFetch<any>("/countPost", {
    method : "POST",
    body : idUser
  })
  const art_total = response.value;

  </script>
