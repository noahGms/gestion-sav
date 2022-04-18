import {createApp} from "vue";
import App from "./app/App";
import router from "./app/router";
import store from "./app/store";

createApp(App).use(router).use(store).mount('#app');
