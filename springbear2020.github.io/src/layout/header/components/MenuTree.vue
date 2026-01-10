<script setup>
defineProps({
  menu: {
    type: Object,
    required: true,
  },
});
</script>

<template>
  <el-sub-menu v-if="menu.children" :index="menu.path">
    <template #title>
      <span>{{ menu.meta.title }}</span>
    </template>

    <!-- 多级嵌套菜单渲染 -->
    <menu-tree
      v-if="menu.children"
      v-for="subMenu in menu.children"
      :menu="subMenu"
    />
  </el-sub-menu>

  <el-menu-item v-else :index="menu.path">
    <span>{{ menu.meta.title }}</span>
  </el-menu-item>
</template>