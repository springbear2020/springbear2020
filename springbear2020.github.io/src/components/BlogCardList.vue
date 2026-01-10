<script setup>
import BlogCardItem from "@/components/BlogCardItem.vue";

defineProps({
  list: {
    type: Array,
    required: true,
  },
});
</script>

<template>
  <div class="card-list-box">
    <blog-card-item v-for="item in list" :card-data="item" />
  </div>
</template>