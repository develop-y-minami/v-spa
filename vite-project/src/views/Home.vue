<!-- Home -->
<template>
    <div>
        <h1>Home Page</h1>
    </div>
</template>

<script setup lang="ts">
    import { defineEmits } from 'vue';

    // ページ名
    const PAGE_NAME = 'Home';
    // ページ名横に表示するアイコンの名称
    const PAGE_ICON_NAME = 'home';

    // 'send-message' イベントを定義
    const emit = defineEmits<{
        (event: 'send-message', data: { pageName: string, pageIconName: string }): void;
    }>();

    // 親コンポーネントにデータを送信
    emit('send-message', { pageName: PAGE_NAME, pageIconName: PAGE_ICON_NAME });
</script>