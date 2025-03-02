<template>
    <!-- エラーメッセージリストを表示 -->
    <div class="error_message_list">
        <div class="error_message" v-for="(message, index) in errorMessagesList" :key="index">
            <!-- ErrorMessageコンポーネントを表示し、閉じるボタンのクリックでremoveErrorMessageを呼び出し -->
            <ErrorMessage :message="message" @close="removeErrorMessage(index)" />
        </div>
    </div>
</template>

<script setup lang="ts">
    import { defineEmits, defineProps } from 'vue';
    import ErrorMessage from '../message/ErrorMessage.vue';

    // 親コンポーネントから渡されたエラーメッセージリストを受け取る
    const props = defineProps<{
        errorMessagesList: string[]; // エラーメッセージの配列
    }>();

    // 親コンポーネントにエラーメッセージ削除イベントを通知するための emit 定義
    const emit = defineEmits<{
        (event: 'remove-error-message', index: number): void; // 'remove-error-message' イベントを親に送信
    }>();

    /**
     * エラーメッセージを削除する関数
     * 
     * 指定されたインデックスのエラーメッセージをリストから削除し、
     * 親コンポーネントに削除イベントを通知します。
     * 
     * @param index 削除するエラーメッセージのインデックス
     */
    const removeErrorMessage = (index: number) => {
        // 指定されたインデックスのエラーメッセージをリストから削除
        props.errorMessagesList.splice(index, 1);
        // 親コンポーネントに削除イベントを通知
        emit('remove-error-message', index);
    };
</script>

<style scoped>
    .error_message_list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
</style>
