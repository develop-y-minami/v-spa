<template>
    <div class="base_container">
        <!-- ヘッダー -->
        <Header :pageName="pageName" :pageIconName="pageIconName"></Header>

        <div class="container">
            <!-- サイドメニュー -->
            <SideMenu />
            
            <main class="main_container">
                <router-view v-slot="{ Component }">
                    <component :is="Component" @send-message="handleMessage" />
                </router-view>
            </main>
        </div>
    </div>
</template>

<script setup lang="ts">
    import { ref, watch } from 'vue';
    import { useRoute } from 'vue-router';
    import Header from './components/layouts/Header.vue';
    import SideMenu from './components/layouts/SideMenu.vue';

    // ページ名
    const pageName = ref<string>('');
    // ページ名横に表示するアイコンの名称
    const pageIconName = ref<string>('');

    // 子コンポーネントからのメッセージを受信
    const handleMessage = (data: { pageName: string, pageIconName: string }) => {
        pageName.value = data.pageName;
        pageIconName.value = data.pageIconName;
    };

    // 現在のルート情報を取得
    const route = useRoute();

    // 現在のルートパスを監視
    watch(() => route.path, () => {
        // ルートパス変更時に値を初期化
        pageName.value = '';
        pageIconName.value = '';
    });
</script>

<style scoped>
    /* ページ全体を内包するコンテナー */
    .base_container {
        display: flex;
        flex-direction: column;
        width: 100%;
        height: 100%;
    }

    /* サイドメニューとメインコンテンツを分割するコンテナー */
    .base_container > .container {
        flex: 1;
        display: flex;
    }

    /* メインコンテンツを内包するコンテナー */
    .main_container {
        flex: 1;
        height: 100%;
    }
</style>