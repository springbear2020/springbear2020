import { createPinia } from "pinia";
import { useDataStore } from "@/pinia/modules/store.js";

const store = createPinia();

export { store, useDataStore };
