<!-- ユーザー一覧 -->
<template>
    <TemplateList>
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
            <UserList></UserList>
        </template>
    </TemplateList>
</template>

<script setup lang="ts">
    import { defineEmits } from 'vue';
    import { useRouter } from 'vue-router';
    import TemplateList from '../components/layouts/TemplateList.vue';
    import UserList from '../components/lists/UserList.vue';

    // ページ名
    const PAGE_NAME = 'ユーザー一覧';
    // ページ名横に表示するアイコンの名称
    const PAGE_ICON_NAME = 'format_list_bulleted';

    // 'send-message' イベントを定義
    const emit = defineEmits<{
        (event: 'send-message', data: { pageName: string, pageIconName: string }): void;
    }>();

    // 親コンポーネントにデータを送信
    emit('send-message', { pageName: PAGE_NAME, pageIconName: PAGE_ICON_NAME });

    // ルーターのインスタンスを取得
    const router = useRouter();

    // 戻るボタンクリック時のイベントを定義
    const goBack = () => {
        // 前ページへ戻る
        router.back();
    };
</script>

<style scoped>
    /* 一覧上部左の要素を内包するコンテナー */
    .listTopLeft {
        display: flex;
        gap: 15px;
    }
</style>
  