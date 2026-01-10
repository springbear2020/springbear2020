import { createRouter, createWebHashHistory } from "vue-router";
import routes from "@/router/modules/index.js";

const router = createRouter({
  history: createWebHashHistory(),
  routes: routes,
});

export default router;
