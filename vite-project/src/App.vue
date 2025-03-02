<template>
    <!-- メインコンテナ（ヘッダー、サイドメニュー、メインコンテンツ） -->
    <div class="base_container">
        <!-- ヘッダー部分 -->
        <Header :pageName="pageName" :pageIconName="pageIconName" />

        <div class="container">
            <!-- サイドメニュー部分 -->
            <SideMenu />
            
            <main class="main_container">
                <!-- Vue Router による動的コンポーネント表示 -->
                <router-view v-slot="{ Component }">
                    <component :is="Component" @send-message="handleMessage" />
                </router-view>
            </main>
        </div>
    </div>

    <!-- ローディングインジケータ -->
    <LoadingIndicator v-if="isLoading" />

    <!-- メッセージモーダル -->
    <MessageModal :isVisible="messageStore.isVisible" @update:isVisible="updateMessageVisibility"/>

    <!-- 完了モーダル -->
    <CompletedModal :isVisible="completedStore.isVisible" @update:isVisible="updateCompletedVisibility"/>

    <!-- 確認モーダル -->
    <ConfirmModal :isVisible="confirmStore.isVisible" @update:isVisible="updateConfirmVisibility"/>
</template>

<script setup lang="ts">
    import { ref, watch, provide } from 'vue';
    import { useRoute } from 'vue-router';
    import Header from './components/layouts/Header.vue';
    import SideMenu from './components/layouts/SideMenu.vue';
    import LoadingIndicator from './components/layouts/LoadingIndicator.vue';
    import MessageModal from './components/modals/MessageModal.vue';
    import CompletedModal from './components/modals/CompletedModal.vue';
    import ConfirmModal from './components/modals/ConfirmModal.vue';
    import { isLoadingKey } from './keys';
    import { messageStore } from './stores/messageStore';
    import { completedStore } from './stores/completedStore';
    import { confirmStore } from './stores/confirmStore';

    // 変数・状態の初期化
    const pageName = ref<string>('');  // ページ名
    const pageIconName = ref<string>('');  // アイコン名
    const isLoading = ref(false);  // ローディングインジケータの状態

    // 現在のルート情報を取得
    const route = useRoute();

    /**
     * ルートパス変更時にヘッダー情報をリセットする
     */
    watch(() => route.path, () => {
        pageName.value = '';
        pageIconName.value = '';
        isLoading.value = false;
    });

    /**
     * 子コンポーネントからのメッセージを受信し、ヘッダー情報を更新する
     * 
     * @param data - 受け取るメッセージデータ（ページ名、アイコン名）
     */
    const handleMessage = (data: { pageName: string, pageIconName: string }) => {
        pageName.value = data.pageName;
        pageIconName.value = data.pageIconName;
    };

    // `provide` を使って `isLoading` を子コンポーネントに渡す
    provide(isLoadingKey, isLoading);
    provide('messageStore', messageStore);
    provide('completedStore', completedStore);
    provide('confirmStore', confirmStore);

    /**
     * メッセージモーダルの表示状態を更新する
     * 
     * @param value - 新しい表示状態 (`true`: 表示, `false`: 非表示)
     */
    const updateMessageVisibility = (value: boolean) => {
        messageStore.isVisible = value;
    };

    /**
     * 完了モーダルの表示状態を更新する
     * 
     * @param value - 新しい表示状態 (`true`: 表示, `false`: 非表示)
     */
    const updateCompletedVisibility = (value: boolean) => {
        completedStore.isVisible = value;
    };

    /**
     * 確認モーダルの表示状態を更新する
     * 
     * @param value - 新しい表示状態 (`true`: 表示, `false`: 非表示)
     */
    const updateConfirmVisibility = (value: boolean) => {
        confirmStore.isVisible = value;
    };
</script>

<style scoped>
    .base_container {
        display: flex;
        flex-direction: column;
        width: 100%;
        height: 100%;
    }

    .base_container > .container {
        flex: 1;
        display: flex;
        height: 100%;
        overflow: hidden;
    }

    .main_container {
        flex: 1;
        height: 100%;
    }
</style>
