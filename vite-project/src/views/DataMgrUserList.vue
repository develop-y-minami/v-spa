<!-- ユーザー一覧 -->
<template>
    <TemplateList>
        <!-- 一覧上部（左）に表示するコンテンツ -->
        <template #listTopLeft>
            <a href="" class="button violet">
                <span class="material-symbols-outlined">add</span>
                <span class="name">ユーザー追加</span>
                <span class="material-symbols-outlined">chevron_right</span>
            </a>
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
</script>

<style scoped>
    
</style>
  