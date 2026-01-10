<script setup>
import { computed } from "vue";

const props = defineProps({
  list: {
    type: Array,
    required: true,
  },
});

const hasPostTime = computed(() => {
  return props.list.some((item) => item.hasOwnProperty("postTime"));
});
</script>

<template>
  <el-table :data="list" border>
    <el-table-column type="index" label="#" align="center" width="50" />
    <el-table-column prop="title" label="链接">
      <template #default="{ row }">
        <el-link :href="row.link" type="primary" target="_blank"
          >{{ row.title }}
        </el-link>
      </template>
    </el-table-column>

    <el-table-column
      v-if="hasPostTime"
      prop="postTime"
      label="发布时间"
      align="center"
    />
  </el-table>
</template>
