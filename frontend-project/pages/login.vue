<template>
  <div class="max-w-xl py-6 px-8 h-80 mt-20 bg-white rounded shadow-xl">
    <form @submit.prevent="onSubmit">
      <div class="mb-6">
        <label for="email" class="block text-gray-800 font-bold">Email:</label>
        <input type="email" v-model="formData.email" id="email" placeholder="email@example.com" class="w-full border border-gray-300 py-2 pl-3 rounded mt-2 outline-none focus:ring-indigo-600 :ring-indigo-600" />
      </div>
      <div>
        <label for="pasword" class="block text-gray-800 font-bold">Password:</label>
        <input type="password" v-model="formData.password" id="password" placeholder="" class="w-full border border-gray-300 py-2 pl-3 rounded mt-2 outline-none focus:ring-indigo-600 :ring-indigo-600" />
      </div>
      <button class="cursor-pointer py-2 px-4 block mt-6 bg-indigo-500 text-white font-bold w-full text-center rounded">Login</button>
    </form>
  </div>
</template>

<script setup lang="ts">
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
  })
  if (response.value !== null){
    const { access_token, token_type } = response.value
    auth.setNewToken(access_token)
    console.log(access_token)

    const { data: user, error } = await useMyFetch<any>('auth/me', {
      method: 'POST'
    })
    if (user.value !== null) {
      const { name, email } = user.value
      auth.setUser(name, email)
      await navigateTo('/')
    }
  }
}

// import { useJwtStore } from '~/stores/piniaAuthStore';

// const jwtStore = useJwtStore();
// const token = 'your_jwt_token_here';
// jwtStore.setToken(token);
</script>