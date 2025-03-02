<template>
    <div class="error_message">
        <div class="message">{{ message }}</div>
        <div class="close" @click="$emit('close')">×</div>
    </div>
</template>

<script setup lang="ts">
    import { defineProps, defineEmits } from 'vue';

    // メッセージのプロパティの型定義
    const props = defineProps<{
        message: string | null;
    }>();

    // 'close' イベントを親コンポーネントに送信
    const emit = defineEmits<{
        (event: 'close'): void;
    }>();

    // メッセージを閉じる処理
    const closeMessage = () => {
        emit('close');
    };
</script>

<style scoped>
    /***************************************************************
    *   エラーメッセージ
    ***************************************************************/
    .error_messages {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    
    .error_message {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px;
        color: white;
        border-radius: 4px;
        background-color: var(--color-red);
    }

    .error_message .close {
        cursor: pointer;
    }
</style>