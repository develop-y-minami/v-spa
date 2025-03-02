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
            <!-- 動的にコンポーネントを挿入 -->
            <component 
                v-if="confirmStore.contentComponent"
                :is="confirmStore.contentComponent"
                v-bind="confirmStore.contentProps"
            />
            <!-- ボタン -->
            <div class="button_container">
                <button @click="handleConfirm" class="button left_icon blue">
                    <span class="material-symbols-outlined">check</span>
                    <span class="name">はい</span>
                </button>
                <button @click="handleCancel" class="button left_icon gray">
                    <span class="material-symbols-outlined">close</span>
                    <span class="name">いいえ</span>
                </button>
            </div>
        </div>
    </Modal>
</template>

<script setup lang="ts">
    import { computed, inject } from 'vue';
    import Modal from '../modals/Modal.vue';
    import { confirmStore } from '../../stores/confirmStore';
    import type { ConfirmStore } from '../../stores/confirmStore';

    // `confirmStore` をインジェクトし、型を指定
    const store = inject<ConfirmStore>('confirmStore', confirmStore);

    if (!store) {
        throw new Error('confirmStoreが見つかりません。');
    }

    // `confirmStore` から状態を取得
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
     * 「はい」ボタンクリック時の処理
     * 
     * この関数は「はい」ボタンがクリックされた際に呼び出され、モーダルを閉じる。
     */
    const handleConfirm = () => {
        store.isVisible = false;

        if (store.onConfirm) {
            store.onConfirm();
        }
    };

    /**
     * 「いいえ」ボタンクリック時の処理
     * 
     * この関数は「いいえ」ボタンがクリックされた際に呼び出され、モーダルを閉じる。
     */
    const handleCancel = () => {
        store.isVisible = false;

        if (store.onCancel) {
            store.onCancel();
        }
    };
</script>

<style scoped>
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
        gap: 10px;
    }
</style>
