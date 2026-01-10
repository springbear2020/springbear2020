<script setup>
import { useRoute } from "vue-router";

const route = useRoute();
</script>

<template>
  <div class="container">
    <router-view :key="route.path" />
  </div>
</template>

<style scoped lang="scss">
.container {
  min-width: 360px;
  margin: 0 auto;
  height: calc(100vh - 60px);
}
</style>
