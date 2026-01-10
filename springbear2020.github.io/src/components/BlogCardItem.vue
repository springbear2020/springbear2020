<script setup>
import { computed } from "vue";

const props = defineProps({
  cardData: {
    type: Object,
    required: true,
  },
});

const dynamicClass = computed(() => {
  return props.cardData.flag ? "card-badge" : "";
});
</script>

<template>
  <el-card shadow="hover" class="card-item-box" :class="dynamicClass">
    <template #header>
      <div class="text-ellipsis" :title="cardData.title">
        <el-link :href="cardData.link" type="primary" target="_blank"
          >{{ cardData.title }}
        </el-link>
      </div>
    </template>

    <template #default>
      <img alt="cover" width="190px" height="90px" :src="cardData.cover" />
    </template>

    <template #footer>
      <div>{{ cardData.postTime }}</div>
    </template>
  </el-card>
</template>

<style scoped lang="scss">
:deep(.el-card__header) {
  text-align: center;
}

:deep(.el-card__header .el-link) {
  font-size: 16px;
}

:deep(.el-card__body) {
  text-align: center;
  font-size: 0;
  padding: 4px 0;
}

:deep(.el-card__footer) {
  text-align: center;
}
</style>
