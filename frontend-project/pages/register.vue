<template>
  <div class="flex h-screen bg-gray-700">
    <div class="w-full max-w-lg m-auto bg-red-900 rounded p-5 flex">
      <div class="w-1/2 pr-4">
        <header>
          <img class="w-20 mx-auto mb-5" src="/image/logo.jpg" />
        </header>
        <form @submit.prevent="onSubmit">
          <div>
            <label class="block mb-1 text-red-500" for="name">Name</label>
            <input v-model="formData.name" class="w-full p-2 mb-6 text-red-700 border-b-2 border-red-500 outline-none focus:bg-gray-300" type="text" name="name">
            <p v-if="name_error !== null" class="pb-4 text-red-600">{{ name_error }}</p>
          </div>
          <div>
            <label class="block mb-2 text-red-500" for="password">Password</label>
            <input v-model="formData.password" class="w-full p-2 mb-6 text-red-700 border-b-2 border-red-500 outline-none focus:bg-gray-300" type="password" name="password">
            <p v-if="password_error !== null" class="pb-4 text-red-600">{{ password_error }}</p>
          </div>
          <div>
            <label class="block mb-2 text-red-500" for="email">Email</label>
            <input v-model="formData.email" class="w-full p-2 mb-6 text-red-700 border-b-2 border-red-500 outline-none focus:bg-gray-300" type="email" name="email">
            <p v-if="email_error !== null" class="pb-4 text-red-600">{{ email_error }}</p>
          </div>
          <div>
            <label class="block mb-2 text-red-500" for="confirm-password">Confirm Password</label>
            <input v-model="formData.confirmPassword" class="w-full p-2 mb-6 text-red-700 border-b-2 border-red-500 outline-none focus:bg-gray-300" type="password" name="confirm-password">
            <p v-if="confirm_password_error !== null" class="pb-4 text-red-600">{{ confirm_password_error }}</p>
          </div>
          <footer>
            <a class="text-red-500 hover:text-black text-sm float-right" href="#">Already have an account? Login</a>
          </footer>
        </form>
      </div>
      <div class="w-1/2 pl-4">
        <div class="mb-24"></div>
        <div>
          <label class="block mb-2 text-red-500" for="tel">Tel</label>
          <input v-model="formData.tel" class="w-full p-2 mb-6 text-red-700 border-b-2 border-red-500 outline-none focus:bg-gray-300" type="tel" name="tel">
          <p v-if="tel_error !== null" class="pb-4 text-red-600">{{ tel_error }}</p>
        </div>
        <div>
          <label class="block mb-2 text-red-500" for="profile_picture">Profile Picture</label>
          <input type="file" class="w-full p-2 mb-6 text-red-700 border-b-2 border-red-500 outline-none focus:bg-gray-300" accept="image/*" name="profile_picture">
        </div>
        <div>
          <button class="w-full bg-red-700 hover:bg-black text-white font-bold py-2 px-4 mb-6 rounded">Submit</button>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup lang="ts">
import { ref, reactive } from 'vue';
import axios from 'axios';
import { useAuthStore } from '~/stores/useAuthStore';

const formData = reactive({
  name: '',
  email: '',
  password: '',
  confirmPassword: '',
  tel: '',
});

const auth = useAuthStore();
const name_error = ref(null);
const email_error = ref(null);
const password_error = ref(null);
const confirm_password_error = ref(null);
const tel_error = ref(null);

const onSubmit = async () =>{
  try {
    const response = await axios.post('/api/auth/register', formData);
    // const response = await useMyFetch<any>('auth/register', {
    //   method: 'POST',
    //   body: formData
    // });
    if (response.status === 201) {
      console.log('registered');
    } else {
      console.log('register fail')
    }

  } catch (error) {
    console.error('Registration error:', error);
  }
};

</script>
  
  
  
  
  
  
  
  
  
  
  
  