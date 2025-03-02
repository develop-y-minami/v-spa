import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import { createPinia } from 'pinia';
import MessageModal from './components/modals/MessageModal.vue';
import CompletedModal from './components/modals/CompletedModal.vue';
import ConfirmModal from './components/modals/ConfirmModal.vue';

// reset.css
import './assets/libs/destyle/destyle.css';
import './assets/css/common/style.css';

const app = createApp(App);

app.use(router);
app.use(createPinia());
app.component('MessageModal', MessageModal);
app.component('CompletedModal', CompletedModal);
app.component('ConfirmModal', ConfirmModal);
app.mount('#app');
