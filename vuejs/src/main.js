import { createApp } from 'vue'
import { createPinia } from "pinia"
import { Button, notification } from 'ant-design-vue';
import App from './App.vue'
import List from './App.vue'
import store from './store'
import Cart from './App.vue'
import {
    Drawer,
    Table,
    Menu,
    Input,
    
    InputPassword
} from 'ant-design-vue'

import router from './router/index.js'
import 'bootstrap/dist/css/bootstrap-grid.min.css'
import 'bootstrap/dist/css/bootstrap-utilities.min.css'
import PrimeVue from 'primevue/config'
import './assets/bootstrap.css'
import './assets/bootstrap.min.css'
import './assets/sb-admin.css'
import './assets/font-size.css'
import './static/fontawesome-free-6.4.2-web/css/all.min.css'
import axios from 'axios'

import VueAwesomePaginate from "vue-awesome-paginate";

// // import the necessary css file
// import "vue-awesome-paginate/dist/style.css";
import "vue-awesome-paginate/dist/style.css";

import 'primevue/resources/themes/saga-blue/theme.css'; // Chọn chủ đề phù hợp
import 'primevue/resources/primevue.min.css'; // CSS chung
import 'primeicons/primeicons.css'; // Icon fonts


window.axios = axios;
const app = createApp(App);
app.use(createPinia());
app.use(store);

app.use(router);
app.use(List);
app.mount('#app');
app.use(Table);
app.use(Cart);
// app.use(Icon);
app.use(Drawer);
app.use(Menu);
app.use(Input);
app.use(InputPassword);
app.use(Button);
app.use(notification);
app.use(PrimeVue);

// app.unmount();
// app.config.globalProperties.$message = message;
app.config.compilerOptions.isCustomElement = (tag) => tag === 'a-table';

