import {createApp} from "vue";
import App from "./app/App";
import router from "./app/router";
import store from "./app/store";

import Antd from 'ant-design-vue';
import 'ant-design-vue/dist/antd.css';

const app = createApp(App);

app.use(Antd);

app.use(router);
app.use(store);
app.mount('#app');
