<template>
    <nav class="flex">
  
      <MenuLink to="/">Home</MenuLink>
      <MenuLink to="/login"  v-if="!auth.isLogin">Login</MenuLink>
      <MenuLink to="/login" @click="logout" v-if="auth.isLogin">Logout</MenuLink>
    </nav>
  </template>
  <script setup lang="ts">
  import { useAuthStore } from '~/stores/useAuthStore';
  
  const auth = useAuthStore() 
  
  function logout() {
    if (auth.isLogin) {
      auth.clear();
    }
    
  }
   
  </script>
  