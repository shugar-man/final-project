<template>
  <div class="flex h-screen bg-gray-700">
    <div class="w-full max-w-lg m-auto bg-red-900 rounded p-5 flex">
      <form @submit.prevent="onSubmit" class="flex" enctype="multipart/form-data">
        <div class="w-1/2 pr-4">
          <header>
              <img class="w-20 mx-auto mb-5" src="/image/logo.jpg" />
            </header>
            <div>
              <label class="block mb-1 text-red-500" for="name">Name</label>
              <input v-model="formData.name" class="w-full p-2 mb-6 text-red-700 border-b-2 border-red-500 outline-none focus:bg-gray-300" type="text" name="name">
              <p v-if="name_error !== null" class="pb-4 text-red-600">{{ name_error }}</p>
            </div>
            <div>
              <label class="block mb-2 text-red-500" for="email">Email</label>
              <input v-model="formData.email" class="w-full p-2 mb-6 text-red-700 border-b-2 border-red-500 outline-none focus:bg-gray-300" type="email" name="email">
              <p v-if="email_error !== null" class="pb-4 text-red-600">{{ email_error }}</p>
            </div>
            <div>
              <label class="block mb-2 text-red-500" for="password">Password</label>
              <input v-model="formData.password" class="w-full p-2 mb-6 text-red-700 border-b-2 border-red-500 outline-none focus:bg-gray-300" type="password" name="password">
              <p v-if="password_error !== null" class="pb-4 text-red-600">{{ password_error }}</p>
            </div>
            <div>
              <label class="block mb-2 text-red-500" for="password_confirmation">Confirm Password</label>
              <input v-model="formData.password_confirmation" class="w-full p-2 mb-6 text-red-700 border-b-2 border-red-500 outline-none focus:bg-gray-300" type="password" name="password_confirmation">
              <!-- <p v-if="confirm_password_error !== null" class="pb-4 text-red-600">{{ confirm_password_error }}</p> -->
            </div>
            <footer>
              <a class="text-red-500 hover:text-black text-sm float-right" href="/login">Already have an account? Login</a>
            </footer>                
        </div>
        <div class="w-1/2 pl-4">
          <div class="mb-24"></div>
          <div>
            <label class="block mb-2 text-red-500" for="tel">Tel</label>
            <input v-model="formData.tel" class="w-full p-2 mb-6 text-red-700 border-b-2 border-red-500 outline-none focus:bg-gray-300" type="text" name="tel">
            <p v-if="tel_error !== null" class="pb-4 text-red-600">{{ tel_error }}</p>
          </div>
          <!-- <div>
              <label class="block mb-2 text-red-500" for="profile_image">Profile Image</label>
              <input type="file" class="w-full p-2 mb-6 text-red-700 border-b-2 border-red-500 outline-none focus:bg-gray-300" accept="image/*" @change="onFileChange" name="profile_image">
          </div> -->
          <div>
            <button class="w-full bg-red-700 hover:bg-black text-white font-bold py-2 px-4 mb-6 rounded" type="submit">Submit</button>
          </div>
        </div>
      </form> 
    </div>
  </div>
</template>
<script setup lang="ts">
import { ref, reactive } from 'vue';
import { useAuthStore } from '~/stores/useAuthStore';
import { useRouter } from 'vue-router';
  
const formData = reactive({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
  tel: '',
  profile_image: '',
});
const onFileChange = (event: Event) => {
  // Cast the event to the correct type
  const fileInput = event.target as HTMLInputElement;
  const selectedFile = fileInput.files?.[0] || null;

  if (selectedFile) {
    // Extract the file name
    const fileName = selectedFile.name;
    console.log('Selected File Name:', fileName);

    // Set the formData.profile_image to the file name
    formData.profile_image = fileName;
  }
};
  
const auth = useAuthStore();
// const name_error = ref<string | null>(null);
// const email_error = ref<string | null>(null);
// const password_error = ref<string | null>(null);
const name_error = ref(null);
const email_error = ref(null);
const password_error = ref(null);
// const confirm_password_error = ref(null);
const tel_error = ref(null);
const router = useRouter();
const clearEmailError = () => {
  email_error.value = null;
}

const clearPasswordError = () => {
  password_error.value = null;
}

const clearNameError = () => {
  name_error.value = null;
}
const clearTelError = () => {
  tel_error.value = null;
}

const onSubmit = async () => {
  console.log('FormData:', formData);
  console.log('FormData:', formData.profile_image);
  clearEmailError();
  clearPasswordError();
  clearNameError();
  clearTelError();
  if (formData.password !== formData.password_confirmation) {
    password_error.value = 'The password and confirm password do not match.';
     // Return early to prevent the API request
  }
  if(formData.password === ''){
    
    password_error.value = "The password field is required.";
  }else{
    if (formData.password.length < 8) {
    password_error.value = 'The password field must be at least 8 characters.';
     // Return early to prevent the API request
    }
  }
  
  if (formData.email === ''){
    email_error.value = 'The email field is required.';
  }

  if (formData.name.length < 5) {
    name_error.value = 'The name field must be at least 5 characters.';
    // Return early to prevent the API request
  }
  if(formData.tel === ''){

  }else if (!/^\d+$/.test(formData.tel)) {
    tel_error.value = 'The tel field must contain only numbers.';
    return;
  }

  if(name_error.value !== null){
    return ;
  }else if(password_error.value !== null){
    return ;
  }else if(email_error.value !== null){
    return ;
  }

    try {
      
      const { data: response, error } = await useMyFetch<any>('auth/register', {
        method: 'POST',
        body: formData
      });
      console.log(error.value?.statusMessage);
      
      //if (response.value === 201) {
      if (error.value?.statusMessage !== 'Unprocessable Content') {
        // console.log(response.value.statusMessage);
        alert("Success Register")
        await navigateTo('/login');
      } else {
        console.log('register fail');
        console.log(response.value);
        const { statusMessage, data } = error.value!;
        //await navigateTo('/login');
        if (data && data.errors) {
          if (data.errors.name) {
            name_error.value = data.errors.name[0];
          }
          if (data.errors.email) {
            email_error.value = data.errors.email[0];
          }
          if (data.errors.password) {
            password_error.value = data.errors.password[0];
          }
          if (data.errors.tel){
            tel_error.value = data.errors.tel[0];
          }
        }
        
      }
    } catch (error) {
      console.error('Registration error:', error);
      // await navigateTo('/login');
    }
  
};
  
</script>