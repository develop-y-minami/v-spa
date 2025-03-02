<template>
    <Modal
        :isVisible="isVisible"
        @update:isVisible="updateVisibility"
        :icon="icon"
        :title="title"
        :closeButtonVisible="closeButtonVisible"
        :canCloseOnOverlayClick="canCloseOnOverlayClick">
        <div class="content">
            <!-- メッセージ -->
            <p class="message">{{ message }}</p>
        </div>
    </Modal>
</template>

<script setup lang="ts">
    import { computed, inject } from 'vue';
    import Modal from '../modals/Modal.vue';
    import { messageStore } from '../../stores/messageStore';
    import type { MessageStore } from '../../stores/messageStore';

    // `messageStore` をインジェクトし、型を指定
    const store = inject<MessageStore>('messageStore', messageStore);

    if (!store) {
        throw new Error('messageStoreが見つかりません。');
    }

    // `messageStore` から状態を取得
    const isVisible = computed(() => store.isVisible);
    const message = computed(() => store.message);
    const title = computed(() => store.title);
    const icon = computed(() => store.icon);
    const closeButtonVisible = computed(() => store.closeButtonVisible);
    const canCloseOnOverlayClick = computed(() => store.canCloseOnOverlayClick);

    /**
     * モーダルの表示状態を更新する関数
     * 
     * @param value 新しい表示状態
     */
    const updateVisibility = (value: boolean) => {
        store.isVisible = value;
    };
</script>

<style scoped>
    /***************************************************************
    *   メッセージモーダル
    ***************************************************************/
    .content {
        padding: 15px;
    }
    .message {
        padding: 15px 40px;
    }
</style>
