<script setup>
import PageHeader from "@/layout/PageHeader.vue";
import PageBody from "@/layout/PageBody.vue";
import { useRoute } from "vue-router";
import routes from "@/router/modules/index.js";
import { watch } from "vue";

const buildPathTitleMap = (routes, map = new Map()) => {
  routes.forEach((route) => {
    if (!route.meta.hidden) {
      map.set(route.path, route.meta.title);
    }
    if (route.children) {
      buildPathTitleMap(route.children, map);
    }
  });
  return map;
};
const route = useRoute();
const pathTitleMap = buildPathTitleMap(routes);
const setPageTitle = (path) => {
  const routeTitle = pathTitleMap.get(path);
  document.title = routeTitle ? `${routeTitle} - 春天熊` : "春天熊的知行录";
};

watch(route, () => setPageTitle(route.path), { immediate: true });
</script>

<template>
  <page-header />
  <page-body />
</template>
