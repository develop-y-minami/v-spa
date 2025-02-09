import { createRouter, createWebHistory } from 'vue-router';
import Home from '../views/Home.vue';
import DataMgrMenu from '../views/DataMgrMenu.vue';
import SettingMenu from '../views/SettingMenu.vue';
import UserList from '../views/UserList.vue';
import UserAdd from '../views/UserAdd.vue';

const routes = [
  { path: '/', name: 'Home', component: Home },
  { path: '/data-mgr/menu', name: 'DataMgrMenu', component: DataMgrMenu },
  { path: '/setting/menu', name: 'SettingMenu', component: SettingMenu },
  { path: '/user', name: 'UserList', component: UserList },
  { path: '/user/add', name: 'UserAdd', component: UserAdd },
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
