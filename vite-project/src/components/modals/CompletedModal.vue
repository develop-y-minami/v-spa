<template>
    <Modal
        :isVisible="isVisible"
        @update:isVisible="updateVisibility"
        :icon="icon"
        :title="title"
        :closeButtonVisible="closeButtonVisible"
        :canCloseOnOverlayClick="canCloseOnOverlayClick">
        <div class="content">
            <!-- 完了メッセージ -->
            <p class="message">{{ message }}</p>
            <!-- 完了ボタン -->
            <div class="button_container">
                <button @click="handleComplete" class="button left_icon blue">
                    <span class="material-symbols-outlined">check_circle</span>
                    <span class="name">完了</span>
                </button>
            </div>
        </div>
    </Modal>
</template>

<script setup lang="ts">
    import { computed, inject } from 'vue';
    import Modal from '../modals/Modal.vue';
    import { completedStore } from '../../stores/completedStore';
    import type { CompletedStore } from '../../stores/completedStore';

    // `completedStore` をインジェクトし、型を指定
    const store = inject<CompletedStore>('completedStore', completedStore);

    if (!store) {
        throw new Error('completedStoreが見つかりません。');
    }

    // `completedStore` から状態を取得
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

    /**
     * 完了ボタンクリック時の処理
     * 
     * この関数は完了ボタンがクリックされた際に呼び出され、モーダルを閉じる。
     */
    const handleComplete = () => {
        store.isVisible = false;

        if (store.onComplete) {
            store.onComplete();
        }
    };
</script>

<style scoped>
    /***************************************************************
    *   完了モーダル
    ***************************************************************/
    .content {
        padding: 15px;
    }
    .message {
        padding: 15px 40px;
    }
    .button_container {
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }
</style>
