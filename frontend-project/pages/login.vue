<template>
  <div class="flex h-screen bg-gray-700">
    <div class="w-full max-w-xs m-auto bg-red-900 rounded p-5">
      <header>
        <img class="w-20 mx-auto mb-5" src="/image/logo.jpg" />
      </header>
      <form @submit.prevent="onSubmit">
        <div>
          <label class="block mb-2 text-red-500" for="email">Email</label>
          <input type="email" v-model="formData.email" id="email" placeholder="email@example.com" class="w-full p-2 mb-6 text-red-700 border-b-2 border-red-500 outline-none focus:bg-gray-300 " />
          <p v-if="email_error !== null" class="pb-4 text-red-600">{{ email_error }}</p>
        </div>
        <div>
          <label class="block mb-2 text-red-500" for="password">Password</label>
          <input type="password" v-model="formData.password" id="password" placeholder="" class="w-full p-2 mb-6 text-red-700 border-b-2 border-red-500 outline-none focus:bg-gray-300 " />
          <p v-if="password_error !== null" class="pb-4 text-red-600">{{ password_error }}</p>
        </div>
        <div>
          <button class="w-full bg-red-700 hover:bg-black text-white font-bold py-2 px-4 mb-6 rounded">Login</button>
        </div>
      </form>
      <footer>
        <!-- <a class="text-red-500 hover:text-black text-sm float-left" href="#">Forgot Password?</a> -->
        <a class="text-red-500 hover:text-black text-sm float-right" href="/register">Create Account</a>
      </footer>
    </div>
  </div>
</template>
<!-- <script setup lang="ts">
import { useAuthStore } from '~/stores/useAuthStore';
const auth = useAuthStore()

const formData = reactive({
  'email': '',
  'password': '',
})

async function onSubmit() {
  const { data: response, error } = await useMyFetch<any>('auth/login', {
    method: 'POST',
    body: formData
  });
  if (response.value !== null) {
    const { access_token, token_type } = response.value;
    auth.setNewToken(access_token);
    console.log(access_token);

    const { data: user, error } = await useMyFetch<any>('auth/me', {
      method: 'POST'
    });

    if (user.value !== null) {
      if (user.value.status === true) {
        const { name, email, profile_image } = user.value;
        auth.setUser(name, email, profile_image);
        await navigateTo('/');
      } else {

        console.log('User is suspended and cannot log in.');
 
      }
    }
  }
}
</script> -->

<script setup lang="ts">
import { useAuthStore } from '~/stores/useAuthStore';
const auth = useAuthStore()
const email_error = ref<string | null>(null);
const password_error = ref<string | null>(null);
const formData = reactive({
  'email': '',
  'password': '',
})
const clearEmailError = () => {
  email_error.value = null;
}

const clearPasswordError = () => {
  password_error.value = null;
}

async function onSubmit() {
  clearEmailError();
  clearPasswordError();
  const { data: response, error } = await useMyFetch<any>('auth/login', {
    method: 'POST',
    body: formData
  })
  //const { statusMessage, data } = error.value!;

    if (!formData.email) {
      email_error.value = "email is required";
      
    }
    if (!formData.password) {
      password_error.value = "password is required";
 
    }
  
  if (response.value !== null){
    const { access_token, token_type } = response.value
    auth.setNewToken(access_token)
    console.log(access_token)
    const { data: user, error } = await useMyFetch<any>('auth/me', {
      method: 'POST'
    })
    if (user.value !== null) {
      const { name, email , profile_image,role} = user.value
      console.log(user.value);
      auth.setUser(name, email, profile_image,role)
      await navigateTo('/')
    }
  }
}
</script>
