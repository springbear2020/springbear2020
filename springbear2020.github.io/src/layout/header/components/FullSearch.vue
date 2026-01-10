<script setup>
import { computed, onMounted, ref, onUnmounted } from "vue";
import { useDataStore } from "@/pinia/modules/store.js";
import routes from "@/router/modules/index.js";
import { Position } from "@element-plus/icons-vue";

const dataStore = useDataStore();
const categoryList = routes
  .filter((item) => !item.meta.hidden)
  .map((item) => {
    const { meta } = item;
    return meta.title;
  });

// 对话框
const showDialog = ref(false);
const handleOpen = () => {
  showDialog.value = true;
};
const handleClosed = () => {
  keyword.value = "";
  selectedIndex.value = 0;
  resultList.value = [];
  categoryChosen.value = categoryList[0];
};
const handleOpened = () => {
  inputRef.value.focus();
};
defineExpose({ handleOpen });

// 对话框 > 内容搜索
const inputRef = ref();
const keyword = ref("");
const selectedIndex = ref(0);
const resultList = ref();
const categoryChosen = ref(categoryList[0]);
const showEmpty = computed(() => {
  return keyword.value.length > 0 && resultList.value.length === 0;
});
const handleSearch = () => {
  selectedIndex.value = 0;

  if (!keyword.value) {
    resultList.value = [];
    return;
  }

  resultList.value = dataStore
    .doSearch(keyword.value, categoryChosen.value)
    .slice(0, 10);
};
const handleClick = (index, link) => {
  selectedIndex.value = index;
  window.open(link);
};

// 键盘事件监听
const handleKeyDown = (event) => {
  if (event.key === "ArrowUp") {
    selectedIndex.value =
      (selectedIndex.value - 1 + resultList.value.length) %
      resultList.value.length;
  } else if (event.key === "ArrowDown") {
    selectedIndex.value = (selectedIndex.value + 1) % resultList.value.length;
  } else if (event.key === "Enter") {
    const { link } = resultList.value[selectedIndex.value];
    window.open(link);
  } else if (event.ctrlKey && event.key === "k") {
    // Ctrl + k 打开对话框
    event.preventDefault();
    handleOpen();
  }
};

onMounted(() => {
  window.addEventListener("keydown", handleKeyDown);
});
onUnmounted(() => {
  window.removeEventListener("keydown", handleKeyDown);
});
</script>

<template>
  <el-dialog
    center
    width="75%"
    v-model="showDialog"
    @closed="handleClosed"
    @opened="handleOpened"
    class="dialog-box"
  >
    <!-- 类别按钮 -->
    <el-radio-group v-model="categoryChosen" @change="handleSearch">
      <el-radio-button v-for="title in categoryList" :value="title">
        {{ title }}
      </el-radio-button>
    </el-radio-group>

    <!-- 输入框 -->
    <el-input
      v-model="keyword"
      @input="handleSearch"
      class="input-box"
      prefix-icon="Search"
      size="large"
      clearable
      placeholder="在此输入搜索内容..."
      ref="inputRef"
    />

    <!-- 搜索结果 -->
    <el-empty v-if="showEmpty" description="空空如也，啥也没找到~" />
    <ul v-else class="result-list">
      <li
        v-for="({ title, link }, index) in resultList"
        :key="index"
        :class="{ selectedLine: index === selectedIndex }"
        class="result-item"
        @click="handleClick(index, link)"
      >
        <el-link :href="link" target="_blank">
          {{ title }}
        </el-link>
        <el-icon>
          <Position />
        </el-icon>
      </li>
    </ul>
  </el-dialog>
</template>

<style scoped lang="scss">
@use "@/styles/variables";

.dialog-box {
  .input-box {
    margin: 16px 0;
  }

  .result-list {
    padding: 0;
    margin: 0;

    .result-item {
      padding: 16px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-radius: 4px;
      cursor: pointer;
    }

    .selectedLine {
      color: variables.$theme-color;
      background-image: linear-gradient(
        to left bottom,
        variables.$bg-white,
        variables.$theme-color
      );
    }
  }
}
</style>
