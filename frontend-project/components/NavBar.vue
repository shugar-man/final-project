<template>
  <nav class="flex">

    <MenuLink to="/">Home</MenuLink>
    <MenuLink to="/">Page</MenuLink>
    <MenuLink to="/post" v-if="auth.isLogin">Post</MenuLink>
    <MenuLink to="/login"  v-if="!auth.isLogin">Login</MenuLink>
    <MenuLink to="/login" @click="logout" v-if="auth.isLogin">Logout</MenuLink>
    <MenuLink to="/profile" v-if="auth.isLogin"><img :src=auth.user.user_profile_image alt="">profile</MenuLink>
    {{ auth.user.name }}
  </nav>
</template>
<script setup lang="ts">

import { useAuthStore } from '~/stores/useAuthStore';

const auth = useAuthStore() 


async function logout() {
  if (auth.isLogin) {
    const { data: user, error } = await useMyFetch<any>('auth/logout', {
    method: 'POST'
    })
    auth.clear();
  }
  
}
</script>
