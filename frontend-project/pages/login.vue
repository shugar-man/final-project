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
        </div>
        <div>
          <label class="block mb-2 text-red-500" for="password">Password</label>
          <input type="password" v-model="formData.password" id="password" placeholder="" class="w-full p-2 mb-6 text-red-700 border-b-2 border-red-500 outline-none focus:bg-gray-300 " />
        </div>
        <div>
          <button class="w-full bg-red-700 hover:bg-black text-white font-bold py-2 px-4 mb-6 rounded">Login</button>
        </div>
      </form>
      <footer>
        <a class="text-red-500 hover:text-black text-sm float-left" href="#">Forgot Password?</a>
        <a class="text-red-500 hover:text-black text-sm float-right" href="/register">Create Account</a>
      </footer>
    </div>
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
      const { name, email , profile_image} = user.value
      auth.setUser(name, email, profile_image)
      await navigateTo('/')
    }
  }
}
</script>
