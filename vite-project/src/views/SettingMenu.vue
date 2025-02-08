<!-- 設定メニュー -->
<template>
    <TemplateMenu>
        
    </TemplateMenu>
</template>

<script setup lang="ts">
    import { defineEmits } from 'vue';
    import TemplateMenu from '../components/layouts/TemplateMenu.vue';

    // ページ名
    const PAGE_NAME = '設定';
    // ページ名横に表示するアイコンの名称
    const PAGE_ICON_NAME = 'settings';

    // 'send-message' イベントを定義
    const emit = defineEmits<{
        (event: 'send-message', data: { pageName: string, pageIconName: string }): void;
    }>();

    // 親コンポーネントにデータを送信
    emit('send-message', { pageName: PAGE_NAME, pageIconName: PAGE_ICON_NAME });
</script>