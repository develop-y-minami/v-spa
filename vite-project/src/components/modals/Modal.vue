<template>
    <div v-show="isVisible" class="modal_overlay overlay" @click="handleOverlayClick">
        <div class="modal" @click="handleModalClick">
            <div class="header">
                <div class="icon">
                    <span class="material-symbols-outlined icon color-blue">{{ icon }}</span>
                </div>
                <div class="title">{{ title }}</div>
                <div v-if="closeButtonVisible" class="close" @click="close">×</div>
            </div>
            <div class="content">
                <slot>
                    <p>コンテンツがありません</p> <!-- デフォルトコンテンツ -->
                </slot>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
    import { defineProps, defineEmits } from 'vue';

    // プロパティの定義
    const props = defineProps({
        // モーダル表示状態
        isVisible: { type: Boolean, required: true },
        // アイコン
        icon: { type: String, default: 'check_circle' },
        // タイトルを受け取る
        title: { type: String, default: 'モーダルタイトル' },
        // 閉じるボタンを表示するか
        closeButtonVisible: { type: Boolean, default: true },
        // オーバーレイクリック時にモーダルを閉じるか
        canCloseOnOverlayClick: { type: Boolean, default: true },
    });

    // イベントの定義
    const emit = defineEmits<{
        (event: 'update:isVisible', value: boolean): void;
    }>();

    /**
     * モーダルを閉じる関数
     * 
     * この関数はオーバーレイや閉じるボタンがクリックされたときに呼び出され、モーダルの表示状態を
     * `false` に更新してモーダルを非表示にします。
     */
    const close = () => {
        emit('update:isVisible', false); // 親にモーダル非表示の状態を伝える
    };

    /**
     * オーバーレイクリック時にモーダルを閉じるかを制御する関数
     * 
     * `canCloseOnOverlayClick` が `true` の場合、オーバーレイをクリックしたときにモーダルが閉じられる。
     * それ以外の場合、オーバーレイクリック時にモーダルを閉じない。
     */
    const handleOverlayClick = () => {
        if (props.canCloseOnOverlayClick) {
            close();
        }
    };

    /**
     * モーダルクリック時の伝播を止める関数
     * 
     * モーダル内のクリックが親コンポーネントに伝播しないようにします。
     */
    const handleModalClick = (event: MouseEvent) => {
        event.stopPropagation();  // 親要素へのクリック伝播を止める
    };
</script>

<style scoped>
    /***************************************************************
    *   モーダル
    ***************************************************************/
    .modal_overlay {
        position: fixed;
        top: 0;
        left: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100vw;
        height: 100vh;
    }
    .modal {
        display: flex;
        flex-direction: column;
        width: 50%;
        border-radius: 3px;
        background-color: white;
    }
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px;
        gap: 15px;
        font-size: 20px;
    }
    .header .title {
        flex: 1;
        text-align: left;
    }
    .icon {
        display: flex;
        align-items: center;
        font-size: 24px;
    }
    .close {
        font-size: 24px;
        cursor: pointer;
    }
    .content {
        font-size: 18px;
    }
</style>
