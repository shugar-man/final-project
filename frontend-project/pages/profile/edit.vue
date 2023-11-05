<template>
  <div class="flex items-center justify-center">
    <div class="profile-edit-container">
      <div class="profile-edit-content">
        <h1 class="profile-edit-title">Name: {{ auth.user.name }}</h1>
        <div class="profile-edit-name">
          <p>New Name:</p>
          <input type="text" class="new-name-input" id="new_name" name="new_name" v-model="auth.user.name">
        </div>
        <div class="profile-image-container">
          <img id="previewImg" class="profile-image" :src="imageURL(auth.user.profile_image)">
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
        <div class="profile-details">
          <p>Email: {{ auth.user.email }}</p>
          <p>Artwork Total: {{ art_total }}</p>
          <p>Tel: <input type="text" id="new_tel" name="new_tel" v-model="auth.user.tel"></p>
        </div>
        <form @submit.prevent="onSubmit">
          <div class="submit-button">
            <button type="submit" class="submit-button">Submit</button>
          </div>
        </form>
          <div class="submit-button">
            <NuxtLink to="/profile" class="back-button">Back</NuxtLink>
          </div>
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
      const new_name = document.getElementById("new_name") as HTMLInputElement;
      const new_tel = document.getElementById('new_tel') as HTMLInputElement;
      console.log(new_name.value);
      
      const body = new FormData();
      body.append('image_path', image_path.value);
      body.append('name',new_name.value)
      body.append('tel',new_tel.value)  
      body.append('id',auth.user.id)
      console.log(body);
      
      const { data: response, error } = await useMyFetch<any>("/profile/edit", {
      method: "POST",
      body
    });
    if (response.value !== null) {
      errorMessage.value = ""
      console.log(response.value);
      auth.setProfileImage(response.value);
      alert('Update Profile')
      await navigateTo('/profile')
    } else { 
      const { statusMessage, data } = error.value!
      errorMessage.value = data.message
      alert(errorMessage.value)
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


<style scoped>
.profile-edit-container {
  background-color: #fff;
  width: 33.333%;
  margin-top: 10px;
  border-radius: 10px;
  padding: 1.5rem;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.profile-edit-title {
  color: #333;
  font-weight: 600;
  font-size: 1.5rem;
  margin-top: 1rem;
}

.profile-edit-name {
  display: flex;
  align-items: center;
  margin-top: 1rem;
}

.new-name-input {
  margin-left: 10px;
  padding: 0.25rem;
}

.profile-image-container {
  display: flex;
  align-items: center;
  margin-top: 1rem;
}

.profile-image {
  width: 8rem;
  height: 8rem;
  border-radius: 50%;
  object-fit: cover;
}

profile-image input[type="file"] {
  display: none;
}

.profile-details {
  color: #555;
  font-size: 0.875rem;
  text-align: center;
  margin-top: 0.5rem;
}

.submit-button {
  margin-top: 1rem;
  text-align: center;
}

.submit-button button {
  background-color: #007bff;
  color: #fff;
  font-weight: 600;
  border: none;
  border-radius: 10px;
  padding: 0.5rem 1rem;
  cursor: pointer;
  transition: background-color 0.3s;
}

.submit-button button:hover {
  background-color: #0056b3;
}
.back-button {
  background-color: #ccc;
  color: #333;
  font-weight: 600;
  border: none;
  border-radius: 10px;
  padding: 0.5rem 1rem;
  text-decoration: none;
  display: inline-block;
  cursor: pointer;
  transition: background-color 0.3s;
}

.back-button:hover {
  background-color: #999;
}
</style>