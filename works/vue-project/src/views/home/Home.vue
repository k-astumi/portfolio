<template>
<div>
    <p>ホームだよ</p>
    <router-link to="/test">次のページ</router-link>
</div>
</template>
<script setup lang="ts"></script>
<style lang="scss" scoped>
div {
    p {
       color: red;
       font-weight: bold;
       font-size: 18px;
    }
}
</style>
