require("./bootstrap");
import { createApp } from "vue";
import App from "./app/App";
import router from "./app/router";
import store from "./app/store";

import Antd from "ant-design-vue";
import "ant-design-vue/dist/antd.css";

createApp(App).use(Antd).use(store).use(router).mount("#app");
