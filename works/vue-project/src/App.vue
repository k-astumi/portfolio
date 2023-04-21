<template>
  <div>
    <HeadComponent> </HeadComponent>
    <router-view />
  </div>
</template>
<script setup lang="ts">
import { RouterLink, RouterView } from "vue-router";
import HeadComponent from "./components/Head.vue";
</script>
<style lang="scss" scoped>
@media (min-width: 1024px) {
}
</style>
