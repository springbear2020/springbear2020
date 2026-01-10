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
const hasFooter = computed(() => {
  return props.cardData.footer;
});
const hasDoubleLine = computed(() => {
  const { firstLine, secondLine } = props.cardData;
  return firstLine && secondLine;
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
      <el-row class="card-body">
        <el-col :span="6">
          <img alt="cover" height="64" :src="cardData.cover" />
        </el-col>
        <el-col :span="18" class="line-box">
          <div v-if="hasDoubleLine">
            <div class="double-line text-ellipsis" :title="cardData.firstLine">
              {{ cardData.firstLine }}
            </div>
            <div class="double-line text-ellipsis" :title="cardData.secondLine">
              {{ cardData.secondLine }}
            </div>
          </div>
          <div v-else class="single-line">
            {{ cardData.firstLine }}
          </div>
        </el-col>
      </el-row>
    </template>

    <template #footer v-if="hasFooter">
      <el-tooltip :content="cardData.comment">
        {{ cardData.footer }}
      </el-tooltip>
    </template>
  </el-card>
</template>

<style scoped lang="scss">
:deep(.el-card__header .el-link) {
  font-size: 16px;
}

.card-body {
  height: 64px;

  .line-box {
    .double-line {
      height: 32px;
      line-height: 32px;
    }

    .single-line {
      height: 64px;
    }
  }
}
</style>
