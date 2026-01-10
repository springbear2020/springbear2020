<script setup>
import { useRoute } from "vue-router";
import { useDataStore } from "@/pinia/modules/store.js";

const route = useRoute();
const { subComponent } = route.meta;

const { loadData } = useDataStore();
const { tips, data } = loadData(route);
</script>

<template>
  <p class="tips-line">{{ tips }}</p>
  <div class="component-box">
    <component :is="subComponent" :list="data" />
  </div>
</template>

<style scoped lang="scss">
.component-box {
  padding-bottom: 12px;

  .el-table {
    margin-bottom: 4px;
  }
}
</style>
