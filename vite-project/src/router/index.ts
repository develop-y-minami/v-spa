import { createRouter, createWebHistory } from 'vue-router';
import Home from '../views/Home.vue';
import DataMgrMenu from '../views/DataMgrMenu.vue';
import DataMgrUserList from '../views/DataMgrUserList.vue';
import SettingMenu from '../views/SettingMenu.vue';

const routes = [
  { path: '/', name: 'Home', component: Home },
  { path: '/data-mgr/menu', name: 'DataMgrMenu', component: DataMgrMenu },
  { path: '/data-mgr/user', name: 'DataMgrUserList', component: DataMgrUserList },
  { path: '/setting/menu', name: 'SettingMenu', component: SettingMenu },
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
