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
const hasCover = computed(() => {
  return props.list.some((item) => item.hasOwnProperty("cover"));
});
const dataArray = computed(() => {
  return props.list.map((item) => {
    const { category } = item;
    const categoryArr = category.split(":");
    item["semester"] = categoryArr[1];
    item["course"] = categoryArr[2];
    return item;
  });
});

const arraySpanMethod = ({ row, rowIndex, columnIndex }) => {
  const processTableRowMerge = (tableData, row, rowIndex, fieldName) => {
    const curVal = row[fieldName];
    const preRow = tableData[rowIndex - 1];
    const preVal = preRow ? preRow[fieldName] : null;

    // 当前单元格内容与上一行相同，因此当前单元格应该与上一行合并，不需要单独渲染
    if (curVal === preVal) {
      return { rowspan: 0, colspan: 0 };
    }

    // 当前单元格内容与上一行不同，从当前行开始合并，并统计后续需要合并的行数
    let rowSpan = 1;
    for (let i = rowIndex + 1; i !== tableData.length; i++) {
      const nextRow = tableData[i];
      const nextVal = nextRow[fieldName];
      if (nextVal === curVal) {
        rowSpan++;
      } else {
        break;
      }
    }

    return { rowspan: rowSpan, colspan: 1 };
  };

  const columnFieldMap = {
    1: "semester",
    2: "course",
  };
  if (columnFieldMap[columnIndex]) {
    return processTableRowMerge(
      dataArray.value,
      row,
      rowIndex,
      columnFieldMap[columnIndex],
    );
  }
};
</script>

<template>
  <el-table
    :data="dataArray"
    border
    :span-method="arraySpanMethod"
  >
    <el-table-column type="index" label="#" align="center" width="50" />
    <el-table-column prop="semester" label="学期" align="center" width="100" />
    <el-table-column prop="course" label="课程" />
    <el-table-column prop="title" label="链接">
      <template #default="{ row }">
        <el-link :href="row.link" type="primary" target="_blank"
          >{{ row.title }}
        </el-link>
      </template>
    </el-table-column>

    <el-table-column
      v-if="hasCover"
      prop="cover"
      label="封面"
      align="center"
      width="216"
    >
      <template #default="{ row }">
        <img :src="row.cover" width="190px" height="90px" alt="cover" />
      </template>
    </el-table-column>
    <el-table-column
      v-if="hasPostTime"
      prop="postTime"
      label="发布时间"
      align="center"
      width="180"
    />
  </el-table>
</template>
