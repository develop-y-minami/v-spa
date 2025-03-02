/**
 * メッセージモーダルの状態を管理するストア
 * 
 * このストアは、通知メッセージを表示・非表示にするための状態とメソッドを提供します。
 * 
 * - `isVisible`: モーダルの表示状態
 * - `message`: 表示するメッセージ
 * - `title`: モーダルのタイトル
 * - `icon`: アイコンの種類
 * - `closeButtonVisible`: 閉じるボタンの表示可否
 * - `canCloseOnOverlayClick`: オーバーレイクリックで閉じるかどうか
 * - `showMessage()`: メッセージモーダルを表示するメソッド
 * - `hideMessage()`: メッセージモーダルを非表示にするメソッド
 */

import { reactive } from 'vue';

/**
 * `messageStore` の型定義
 */
export interface MessageStore {
    isVisible: boolean;
    message: string;
    title: string;
    icon: string;
    closeButtonVisible: boolean;
    canCloseOnOverlayClick: boolean;
    showMessage: (message: string, title?: string, icon?: string, closeButtonVisible?: boolean, canCloseOnOverlayClick?: boolean) => void;
    hideMessage: () => void;
}

/**
 * `messageStore` の状態管理
 */
export const messageStore = reactive<MessageStore>({
    isVisible: false,
    message: '',
    title: '通知',
    icon: 'info',
    closeButtonVisible: true,
    canCloseOnOverlayClick: true,

    /**
     * メッセージモーダルを表示する
     * 
     * @param {string} message - 表示するメッセージ
     * @param {string} [title='通知'] - モーダルのタイトル（デフォルトは '通知'）
     * @param {string} [icon='info'] - 表示するアイコン（デフォルトは 'info'）
     * @param {boolean} [closeButtonVisible=true] - 閉じるボタンを表示するかどうか（デフォルトは true）
     * @param {boolean} [canCloseOnOverlayClick=true] - オーバーレイクリックで閉じられるかどうか（デフォルトは true）
     */
    showMessage(message: string, title: string = '通知', icon: string = 'info', closeButtonVisible: boolean = true, canCloseOnOverlayClick: boolean = true) {
        this.message = message;
        this.title = title;
        this.icon = icon;
        this.closeButtonVisible = closeButtonVisible;
        this.canCloseOnOverlayClick = canCloseOnOverlayClick;
        this.isVisible = true;
    },

    /**
     * メッセージモーダルを非表示にする
     */
    hideMessage() {
        this.isVisible = false;
    }
});
