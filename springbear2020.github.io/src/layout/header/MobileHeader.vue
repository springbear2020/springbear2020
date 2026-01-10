<script setup>
import { useRoute, useRouter } from "vue-router";
import { ref } from "vue";
import { Operation } from "@element-plus/icons-vue";
import MenuTree from "@/layout/header/components/MenuTree.vue";
import IconLink from "@/layout/header/components/IconLink.vue";

defineProps({
  menus: {
    type: Array,
    required: true,
  },
});

const route = useRoute();
const router = useRouter();

const showDrawer = ref(false);
const handleOpen = () => {
  showDrawer.value = true;
};
const handleSelect = () => {
  showDrawer.value = false;
};
const handleClick = () => {
  showDrawer.value = false;
  router.push("/");
};
</script>

<template>
  <div class="header-box">
    <img
      src="/images/logo.png"
      alt="logo"
      class="logo-image"
      @click="handleClick"
    />

    <el-icon class="more-icon" size="32" @click="handleOpen">
      <Operation />
    </el-icon>
  </div>

  <el-drawer size="360px" v-model="showDrawer" class="drawer-box">
    <template #header>
      <div class="logo-box">
        <img
          src="/images/logo.png"
          alt="logo"
          class="logo-image"
          @click="handleClick"
        />
      </div>
    </template>

    <el-menu
      mode="vertical"
      router
      :default-active="route.path"
      @select="handleSelect"
    >
      <menu-tree v-for="menu in menus" :menu="menu" />
    </el-menu>

    <icon-link />
  </el-drawer>
</template>

<style scoped lang="scss">
@use "@/styles/variables";

.header-box {
  .more-icon {
    color: variables.$theme-color;
    cursor: pointer;
  }
}

.drawer-box {
  .logo-box {
    display: flex;
    align-items: center;

    .logo-image {
      height: 32px;
      border-radius: 4px;
      cursor: pointer;
      font-size: 0;
    }
  }

  .el-menu {
    border: none;
    margin-bottom: 32px;
  }
}
</style>

<style lang="scss">
.el-drawer__header {
  margin-bottom: 0;
}
</style>
