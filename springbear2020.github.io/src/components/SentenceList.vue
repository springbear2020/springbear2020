<script setup>
import { computed } from "vue";

const props = defineProps({
  list: {
    type: Array,
    required: true,
  },
});
const shuffleArray = (array) => {
  for (let i = array.length - 1; i > 0; i--) {
    // 随机生成一个 0 到 i 之间的索引
    const j = Math.floor(Math.random() * (i + 1));
    // 交换 array[i] 和 array[j]
    [array[i], array[j]] = [array[j], array[i]];
  }
  return array;
};
const dataList = computed(() => {
  return shuffleArray(props.list);
});
</script>

<template>
  <ol
    class="sentence-box"
    v-for="{ author, dynasty, title, sentence, link } in dataList"
  >
    <li class="sentence-item">
      <p class="sentence">{{ sentence }}</p>
      <p class="source">
        <el-link :href="link" type="primary" target="_blank">
          <span>——&nbsp;</span>
          <span v-show="dynasty">{{ dynasty }}&nbsp;·&nbsp;</span>
          <span v-show="author">{{ author }}</span>
          <span v-show="title">《{{ title }}》</span>
        </el-link>
      </p>
    </li>
  </ol>
</template>

<style scoped lang="scss">
@use "@/styles/variables";

.sentence-box {
  background-color: variables.$bg-white;
  list-style: none;
  padding: 0;
  border-radius: 4px;
  border: 1px dashed variables.$theme-color;
  margin: 0 0 4px;

  .sentence-item {
    padding: 16px;

    .sentence {
      margin: 0;
    }

    .source {
      margin: 0;
      text-align: right;
      padding-top: 8px;
    }
  }
}

.sentence-box:last-child {
  margin-bottom: 0;
}
</style>
