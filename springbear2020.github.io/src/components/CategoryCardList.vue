<script setup>
import CategoryCardItem from "@/components/CategoryCardItem.vue";
import { computed } from "vue";

const props = defineProps({
  list: {
    type: Array,
    required: true,
  },
});

const categoryMap = computed(() => {
  return props.list.reduce((map, item) => {
    (map[item.subCategory] ||= []).push(item);
    return map;
  }, {});
});
</script>

<template>
  <div class="category-list-box" v-for="category in Object.keys(categoryMap)">
    <h2>{{ category }}</h2>
    <div class="card-list-box">
      <category-card-item
        v-for="item in categoryMap[category]"
        :card-data="item"
      />
    </div>
  </div>
</template>

<style scoped lang="scss">
.category-list-box {
  h2 {
    padding: 0 16px;
    margin-top: 12px;
    margin-bottom: 16px;
  }
}
</style>
