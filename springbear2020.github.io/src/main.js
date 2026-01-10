import { createApp } from "vue";
import ElementPlus from "element-plus";
import zhCn from "element-plus/es/locale/lang/zh-cn";
import * as ElementPlusIconsVue from "@element-plus/icons-vue";
import "element-plus/dist/index.css";
import "normalize.css/normalize.css";
import "@/styles/element/index.scss";
import "@/styles/index.scss";
import "@/styles/mobile.scss";
import App from "@/App.vue";
import router from "@/router/index";
import { store } from "@/pinia";

const app = createApp(App);
for (const [key, component] of Object.entries(ElementPlusIconsVue)) {
  app.component(key, component);
}

app
  .use(ElementPlus, {
    locale: zhCn,
  })
  .use(router)
  .use(store)
  .mount("#app");
