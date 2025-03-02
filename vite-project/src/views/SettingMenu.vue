<!-- 設定メニュー -->
<template>
    <TemplateMenu>
        
    </TemplateMenu>
</template>

<script setup lang="ts">
    import { defineEmits, onMounted } from 'vue';
    import TemplateMenu from '../components/layouts/TemplateMenu.vue';

    // ページ名
    const PAGE_NAME = '設定';
    // ページ名横に表示するアイコンの名称
    const PAGE_ICON_NAME = 'settings';

    // 'send-message' イベントを定義
    const emit = defineEmits<{
        (event: 'send-message', data: { pageName: string, pageIconName: string }): void;
    }>();

    /**
     * 初期化処理
     */
    const initialize = () => {
        // 親コンポーネントにページ名とアイコン名を送信
        emit('send-message', { pageName: PAGE_NAME, pageIconName: PAGE_ICON_NAME });
    };

    /**
     * コンポーネントがマウントされた際に、初期化処理を実行する
     * 
     * `onMounted` はコンポーネントが DOM にマウントされた後に呼ばれるライフサイクルフックです。
     * このフック内で `initialize` 関数を呼び出すことで、コンポーネントが表示されるタイミングで
     * 初期化処理が行われます。例えば、ページ名やアイコン名の送信、API呼び出しなどが含まれます。
     */
    onMounted(() => {
        // コンポーネントが画面に表示された際に、初期化処理を呼び出して実行する
        initialize(); // 初期化処理を実行
    });
</script>