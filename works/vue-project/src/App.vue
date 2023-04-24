<template>
  <div class="wrapper">
    <div class="contents">
      <router-view />
    </div>
    <FooterComponent></FooterComponent>
  </div>
</template>
<script setup lang="ts">
import { RouterLink, RouterView } from "vue-router";
import FooterComponent from "@/components/Footer.vue";
</script>
<style lang="scss" scoped>
@import url("https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@200&display=swap");
.wrapper {
  display: flex;
  flex-direction: column;
  height: 100vh;
  font-family: "Noto Sans JP", sans-serif;
  .contents {
    flex: 1;
  }
}
@media (min-width: 800px) {
}
</style>
