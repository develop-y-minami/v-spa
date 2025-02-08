<!-- 共通サイドメニュー -->
<template>
    <aside class="side_menu">
        <!-- Home -->
        <div v-if="showHeader">
            <div class="menu">
                <router-link to="/">
                    <span class="material-symbols-outlined icon">home</span>
                </router-link>
            </div>
        </div>
        <!-- データ管理 -->
        <div class="menu">
            <router-link to="/data-mgr/menu">
                <span class="material-symbols-outlined">database</span>
            </router-link>
        </div>
        <!-- 設定 -->
        <div class="menu">
            <router-link to="/setting/menu">
                <span class="material-symbols-outlined">settings</span>
            </router-link>
        </div>
    </aside>
</template>

<script setup lang="ts">
    import { computed } from 'vue';
    import { useRoute } from 'vue-router';

    // 現在のルート情報を取得
    const route = useRoute();

    // Homeメニューを表示する条件を指定
    const showHeader = computed(() => route.path !== '/');
</script>

<style scoped>
    /***************************************************************
    *   サイドメニュー
    ***************************************************************/
    .side_menu {
        height: 100%;
        color: white;
        background-color: black;
    }
    .menu a {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 15px;
        border-bottom: solid 1px white;
        cursor: pointer;
    }
    .menu a:hover {
        color: black;
        background-color: white;
    }
</style>