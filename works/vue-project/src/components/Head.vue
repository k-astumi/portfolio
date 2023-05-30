<template>
  <div class="main-visual">
    <p class="title">Vue.js 作品集</p>
  </div>
</template>
<script setup lang="ts"></script>
<style lang="scss" scoped>
.main-visual {
  background-image: radial-gradient(
    circle at 100px 200px,
    #30485e 0% 50%,
    #3fba84 99% 100%
  );
  text-align: center;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  .title {
    font-size: 30px;
    color: #fff;
    animation-name: fadeUpAnime;
    animation-duration: 1.5s;
    animation-fill-mode: forwards;
    opacity: 0;
  }

  @keyframes fadeUpAnime {
    from {
      opacity: 0;
      transform: translateY(70px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
}
@media (min-width: 800px) {
  .main-visual {
    .title {
      font-size: 70px;
      &::before {
        content: "";
        display: inline-block;
        width: 1px;
        height: 100px;
        background-color: #57ffb6;
        position: absolute;
        left: 50%;
        bottom: -180px;
      }
      &::after {
        content: "";
        display: inline-block;
        width: 1px;
        height: 20px;
        background-color: #57ffb6;
        transform: rotate(45deg);
        position: absolute;
        left: calc(50% + 7px);
        bottom: -184px;
      }
    }
  }
}
</style>
