<!-- 共通サイドメニュー -->
<template>
    <aside class="side_menu">
        <!-- Home -->
        <div class="menu">
            <router-link to="/">
                <span class="material-symbols-outlined icon">home</span>
            </router-link>
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