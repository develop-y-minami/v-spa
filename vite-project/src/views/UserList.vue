<!-- ユーザー一覧 -->
<template>
    <TemplateList :errorMessagesList="errorMessagesList">
        <!-- 一覧上部（左）に表示するコンテンツ -->
        <template #listTopLeft>
            <div class="listTopLeft">
                <button @click="goBack" class="button left_icon gray">
                    <span class="material-symbols-outlined">first_page</span>
                    <span class="name">戻る</span>
                </button>
                <router-link to="/user/add" class="button violet">
                    <span class="material-symbols-outlined">add</span>
                    <span class="name">ユーザー追加</span>
                    <span class="material-symbols-outlined">chevron_right</span>
                </router-link>
            </div>
        </template>
        <!-- 一覧上部（右）に表示するコンテンツ -->
        <template #listTopRight>
            <span class="material-symbols-outlined icon color-violet sub_menu_open_icon">menu</span>
        </template>
        <!-- 一覧 -->
        <template #list>
            <UserList @initialize-success="handleInitializeSuccess" @error="handleError" @clear-errors="handleClearErrors"></UserList>
        </template>
    </TemplateList>
</template>

<script setup lang="ts">
    import { ref, defineEmits, onMounted, inject } from 'vue';
    import type { Ref } from 'vue';
    import { useRouter } from 'vue-router';
    import { isLoadingKey } from '../keys';
    import TemplateList from '../components/layouts/TemplateList.vue';
    import UserList from '../components/lists/UserList.vue';

    // エラーメッセージリスト（初期化エラー時に表示）
    const errorMessagesList = ref<string[]>([]);

    // ページ名とアイコン名の設定
    const PAGE_NAME = 'ユーザー一覧';
    const PAGE_ICON_NAME = 'format_list_bulleted';

    // 'send-message' イベントを定義
    const emit = defineEmits<{
        (event: 'send-message', data: { pageName: string, pageIconName: string }): void;
    }>();

    // ルーターのインスタンスを取得
    const router = useRouter();

    // `isLoading` を inject で取得
    const isLoading = inject(isLoadingKey) as Ref<boolean>;

    /**
     * 初期化処理
     * - ページ名とアイコン名を親コンポーネントに送信
     * - ローディング状態を開始
     */
    const initialize = () => {
        // 親コンポーネントにページ名とアイコン名を送信
        emit('send-message', { pageName: PAGE_NAME, pageIconName: PAGE_ICON_NAME });

        // ローディング開始
        if (isLoading) isLoading.value = true;
    };

    /**
     * コンポーネントがマウントされた際に、初期化処理を実行する
     * - コンポーネントがDOMにマウントされた後に呼び出されるライフサイクルフック `onMounted` を使用
     * - 初期化処理を実行して、ページ情報をセットする
     */
    onMounted(() => {
        initialize(); // 初期化処理を実行
    });

    /**
     * 戻るボタンをクリックしたときの処理
     * - ルーターを使って前のページに戻る
     */
    const goBack = () => {
        // 前ページへ戻る
        router.back();
    };

    /**
     * `UserList` コンポーネントの初期化成功時の処理
     * - ローディング終了フラグを設定
     */
    const handleInitializeSuccess = () => {
        // ローディング終了
        if (isLoading) isLoading.value = false;
    };

    /**
     * `UserList` コンポーネントのエラー時の処理
     * - エラーメッセージをリストに追加
     * - ローディング終了フラグを設定
     */
     const handleError = (message: string) => {
        console.error('エラー:', message);
        errorMessagesList.value.push(message);
        // ローディング終了
        if (isLoading) isLoading.value = false;
    };

    /**
     * エラーメッセージリストをクリアする処理
     * 
     * - エラーメッセージが表示されている場合、この関数を呼び出すことで
     *   すべてのエラーメッセージをリストから削除します。
     * - エラー表示をリセットするために使用されます。
     */
    const handleClearErrors = () => {
        // エラーメッセージリストを空にする
        errorMessagesList.value = [];
    };
</script>

<style scoped>
    /* 一覧上部左の要素を内包するコンテナー */
    .listTopLeft {
        display: flex;
        gap: 15px;
    }
</style>
  