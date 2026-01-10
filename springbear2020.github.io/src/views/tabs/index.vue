<script setup>
import { useRoute } from "vue-router";
import { useDataStore } from "@/pinia/modules/store.js";

const route = useRoute();
const { title, tabs } = route.meta;

const { loadData } = useDataStore();
const { tips, data } = loadData(route);

const filter = (label, ignoreRouteTitle = false) => {
  const categoryStr = ignoreRouteTitle ? label : `${title}:${label}`;
  return data.filter(({ category }) => category.startsWith(categoryStr));
};
</script>

<template>
  <p class="tips-line">{{ tips }}</p>

  <el-tabs type="card">
    <el-tab-pane
      lazy
      v-for="{ label, subComponent, ignoreRouteTitle } in tabs"
      :label="label"
    >
      <div class="component-box">
        <component :is="subComponent" :list="filter(label, ignoreRouteTitle)" />
      </div>
    </el-tab-pane>
  </el-tabs>
</template>

<style scoped lang="scss">
@use "@/styles/variables";

:deep(.el-tabs__header) {
  background-color: variables.$bg-white;
  margin-bottom: 16px;
}

.component-box {
  padding-bottom: 16px;
}
</style>
