<template>
    <div class = "bg-gray-900 text-gray-100 py-3.5 px-6 shadow md:flex justify-between item-center">
      <div class="flex item-center cursor-pointer">
        <span>
          <DropDownMenu></DropDownMenu>
        </span>
        <span class="ml-4"> 
          <Logo></Logo>
        </span>
      </div>
      <ul class="md:flex md:items-center">
        <MenuLink to="/">Home</MenuLink>
        <MenuLink to="/shop">Shop</MenuLink>
        <MenuLink to="/posts/create" v-if="auth.isLogin">Post</MenuLink>
        <DropDownProfile></DropDownProfile>
      </ul>
      
    </div>
</template>

<script setup lang="ts">
import { useAuthStore } from '~/stores/useAuthStore';
const auth = useAuthStore() 
</script>
