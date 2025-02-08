<!-- ユーザー一覧 -->
<template>
    <div class="page_list">
        
    </div>
</template>

<script setup lang="ts">
    import { defineEmits } from 'vue';

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
  