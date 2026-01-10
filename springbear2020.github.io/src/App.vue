<script setup>
import PageLayout from "@/layout/PageLayout.vue";
import { useDataStore } from "@/pinia/index.js";
import { onMounted } from "vue";

const { initData } = useDataStore();

onMounted(initData);
</script>

<template>
  <page-layout />
</template>

<style lang="scss">
@use "@/styles/variables";

.el-tabs--card > .el-tabs__header .el-tabs__item.is-active {
  border-bottom-color: variables.$theme-color;
}
</style>
