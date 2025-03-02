<!-- 一覧表示用のテンプレート -->
<template>
    <div class="template_list">
        <div class="list_container">
            <div class="top">
                <div class="left">
                    <slot name="listTopLeft"></slot>
                </div>
                <div class="right">
                    <slot name="listTopRight"></slot>
                </div>
            </div>
            <div v-if="errorMessagesList.length > 0">
                <div class="error_message" >
                    <ErrorMessageManager :errorMessagesList="errorMessagesList"/>
                </div>
            </div>
            <div class="list_wrap">
                <slot name="list"></slot>
            </div>
        </div>

        <div class="sub_menu_container_wrap">
            <div class="sub_menu_container">

            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
    import ErrorMessageManager from '../message/ErrorMessageManager.vue'

    // 親から渡されたエラーメッセージリストを受け取る
    const props = defineProps<{
        errorMessagesList: string[];
    }>();
</script>

<style scoped>
    /* エラーメッセージを内包するコンテナー */
    .error_message { padding: 15px; }
</style>