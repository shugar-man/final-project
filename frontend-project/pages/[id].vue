<template>

</template>

<script setup lang="ts">
const route = useRoute()
// const config = useRuntimeConfig()
// console.log(config.public.apiBaseURL)
const pageTitle = `User Name. ${route.params.id}`

type Artist = {
  id: BigInteger,
  name: string,
}
const { data: user } = await useMyFetch<any>(
  `/${route.params.id}`,
  {}
)
console.log(user)
// const { data: users, pending } = await useMyFetch<any>("/showPage", {})


</script>