<script setup>
import { ref, onMounted, onUnmounted, computed } from "vue";
import DesktopHeader from "@/layout/header/DesktopHeader.vue";
import MobileHeader from "@/layout/header/MobileHeader.vue";
import routes from "@/router/modules/index.js";

// 动态加载头部组件
const RESIZE_THRESHOLD = 867;
const menus = routes.filter((route) => !route.meta.hidden);
const innerWidth = ref(window.innerWidth);
const headerComponent = computed(() => {
  return innerWidth.value < RESIZE_THRESHOLD ? MobileHeader : DesktopHeader;
});
const handleResize = () => {
  innerWidth.value = window.innerWidth;
};

onMounted(() => {
  window.addEventListener("resize", handleResize);
});
onUnmounted(() => {
  window.removeEventListener("resize", handleResize);
});
</script>

<template>
  <component :is="headerComponent" :menus="menus" />
</template>
