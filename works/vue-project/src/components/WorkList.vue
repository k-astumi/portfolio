<template>
  <div class="work">
    <div class="work__list" v-for="item in workData">
      <div class="work__img">
        <img class="img" :src="item.image" />
      </div>
      <div class="work__text">
        <router-link :to="item.url" class="work-link">
          <p class="title">{{ item.title }}</p>
          <p class="description">{{ item.description }}</p>
        </router-link>
      </div>
    </div>
  </div>
</template>
<script setup lang="ts">
import workData from "@/data/workData.json";
</script>
<style lang="scss" scoped>
.work {
  padding: 16px 16px 40px;
  &__list {
    & + & {
      margin-top: 64px;
    }
  }
  &__img {
    border: 1px solid #daddde;
    .img {
      width: 100%;
      height: auto;
      vertical-align: bottom;
    }
  }
  &__text {
    border: 1px solid #707070;
    background: url(@/assets/icon_arrow_right.svg) no-repeat #fff right 8px
      center / 16px auto;
    margin-top: 16px;
    .title {
      font-size: 20px;
      font-weight: bold;
    }
    .descriotion {
      font-size: 12px;
    }
    .work-link {
      display: block;
      padding: 16px 24px 16px 16px;
      text-decoration: none;
      color: #333;
    }
  }
}
@media (min-width: 800px) {
  .work {
    width: 70vw;
    margin: 0 auto;
    padding: 80px 0 160px;
    &__list {
      position: relative;
      & + & {
        margin-top: 200px;
      }
    }
    &__img {
      width: 50vw;
    }
    &__text {
      width: 40vw;
      position: absolute;
      right: 0;
      bottom: -110px;
      transition-duration: 0.3s;
      &:hover {
        transform: scale(102%);
      }
      .title {
        font-size: 26px;
      }
      .descriotion {
        margin-top: 8px;
        font-size: 14px;
      }
    }
    .work-link {
      padding: 40px;
      &:hover {
        color: #3fba84;
      }
    }
  }
}
</style>
