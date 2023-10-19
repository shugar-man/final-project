<template>
    <div class="flex h-screen bg-gray-700">
      <div class="w-full max-w-lg m-auto bg-red-900 rounded p-5 flex">
        <div class="w-1/2 pr-4">
          <header>
            <img class="w-20 mx-auto mb-5" src="/image/logo.jpg" />
          </header>
          <form>
            <div>
              <label class="block mb-1 text-red-500" for="username">Username</label>
              <input class="w-full p-2 mb-6 text-red-700 border-b-2 border-red-500 outline-none focus:bg-gray-300" type="text" name="username">
            </div>
            <div>
              <label class="block mb-2 text-red-500" for="password">Password</label>
              <input class="w-full p-2 mb-6 text-red-700 border-b-2 border-red-500 outline-none focus:bg-gray-300" type="password" name="password">
            </div>
            <div>
              <label class="block mb-2 text-red-500" for="email">Email</label>
              <input class="w-full p-2 mb-6 text-red-700 border-b-2 border-red-500 outline-none focus:bg-gray-300" type="email" name="email">
            </div>
            <div>
              <label class="block mb-2 text-red-500" for="confirm-password">Confirm Password</label>
              <input class="w-full p-2 mb-6 text-red-700 border-b-2 border-red-500 outline-none focus:bg-gray-300" type="password" name="confirm-password">
            </div>
          </form>
          <footer>
            <a class="text-red-500 hover:text-black text-sm float-right" href="#">Already have an account? Login</a>
          </footer>
        </div>
        <div class="w-1/2 pl-4">
          <div class="mb-24">
            
          </div>
          <div>
            <label class="block mb-2 text-red-500" for="confirm-password">Tel</label>
            <input class="w-full p-2 mb-6 text-red-700 border-b-2 border-red-500 outline-none focus:bg-gray-300" type="tel" name="tel">
          </div>
          <div>
            <label class="block mb-2 text-red-500" for="profile_picture">Profile Picture</label>
            <input type="file" class="w-full p-2 mb-6 text-red-700 border-b-2 border-red-500 outline-none focus:bg-gray-300" accept="image/*" name="profile_picture">
          </div>
        </div>
      </div>
    </div>
</template>
<script setup lang="ts">

</script>
  
  
  
  
  
  
  
  
  
  
  
  