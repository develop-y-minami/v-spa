import { createApp } from 'vue';
import App from './App.vue';
import router from './router';

// reset.css
import './assets/libs/destyle/destyle.css'
import './assets/css/common/style.css'

const app = createApp(App);
app.use(router);
app.mount('#app');
