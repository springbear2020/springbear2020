<script setup>
import FullSearch from "@/layout/header/components/FullSearch.vue";
import { computed, ref } from "vue";

const props = defineProps({
  showSearch: {
    type: Boolean,
    default: false,
  },
});
const dynamicStyle = computed(() => {
  return props.showSearch
    ? {
        margin: "0 4px",
      }
    : null;
});

const fullSearchRef = ref();
const handleOpen = () => {
  fullSearchRef.value.handleOpen();
};
</script>

<template>
  <div class="link-box">
    <a v-if="showSearch" @click="handleOpen">
      <img class="link-item" src="/svg/search.svg" alt="search" />
    </a>
    <a href="https://springbear.blog.csdn.net" target="_blank">
      <img
        class="link-item"
        src="/svg/csdn.svg"
        alt="csdn"
        :style="dynamicStyle"
      />
    </a>
    <a href="https://github.com/springbear2020" target="_blank">
      <img class="link-item" src="/svg/github.svg" alt="github" />
    </a>
  </div>

  <full-search v-if="showSearch" ref="fullSearchRef" />
</template>

<style scoped lang="scss">
@use "@/styles/variables";

.link-box {
  display: flex;
  align-items: center;
  justify-content: space-evenly;

  .link-item {
    cursor: pointer;
    border-bottom: 1px solid transparent;
    border-top: 1px solid transparent;
  }

  .link-item:hover {
    border-bottom: 1px solid variables.$theme-color;
  }
}
</style>
