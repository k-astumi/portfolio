<template>
  <header>
    <p class="title">Vue.js作品集</p>
  </header>
</template>
<script setup lang="ts"></script>
<style lang="scss" scoped>
header {
  background-image: radial-gradient(
    circle at 100px 200px,
    #30485e 0% 40%,
    #3fba84 60% 100%
  );
  text-align: center;
  heigt .title {
    font-size: 20px;
    font-weight: bold;
  }
}
@media (min-width: 800px) {
  header {
    .title {
      font-size: 30px;
    }
  }
}
</style>
