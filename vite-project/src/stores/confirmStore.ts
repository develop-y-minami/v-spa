import { reactive, type Component } from 'vue';

/**
 * 確認モーダルの状態を管理するストア
 * 
 * このストアは、確認メッセージを表示・非表示にするための状態とメソッドを提供します。
 * 
 * - `isVisible`: モーダルの表示状態
 * - `message`: 表示するメッセージ
 * - `title`: モーダルのタイトル
 * - `icon`: アイコンの種類
 * - `closeButtonVisible`: 閉じるボタンの表示可否
 * - `canCloseOnOverlayClick`: オーバーレイクリックで閉じるかどうか
 * - `contentComponent`: モーダル内に表示する動的コンポーネント
 * - `contentProps`: 動的コンポーネントに渡すプロパティ
 * - `onConfirm`: 「はい」ボタンがクリックされた時のコールバック関数
 * - `onCancel`: 「いいえ」ボタンがクリックされた時のコールバック関数
 * - `showConfirm()`: 確認モーダルを表示するメソッド
 * - `hideConfirm()`: 確認モーダルを非表示にするメソッド
 */

export interface ConfirmStore {
    isVisible: boolean;
    message: string;
    title: string;
    icon: string;
    closeButtonVisible: boolean;
    canCloseOnOverlayClick: boolean;
    contentComponent?: Component; // 動的コンポーネントを設定するプロパティ
    contentProps: Record<string, any>; // 動的コンポーネントに渡すプロパティ
    onConfirm?: () => void;  // 「はい」ボタンクリック時に実行されるコールバック関数
    onCancel?: () => void;  // 「いいえ」ボタンクリック時に実行されるコールバック関数
    showConfirm: (
        message: string,
        title?: string,
        icon?: string,
        closeButtonVisible?: boolean,
        canCloseOnOverlayClick?: boolean,
        contentComponent?: Component,
        contentProps?: Record<string, any>,
        onConfirm?: () => void,
        onCancel?: () => void
    ) => void;
    hideConfirm: () => void;
}

export const confirmStore = reactive<ConfirmStore>({
    isVisible: false,
    message: '',
    title: '確認',
    icon: 'help',
    closeButtonVisible: true,
    canCloseOnOverlayClick: true,
    contentComponent: undefined,
    contentProps: {}, // 初期値を追加
    onConfirm: undefined,
    onCancel: undefined,

    /**
     * 確認モーダルを表示する
     * 
     * @param {string} message - 表示するメッセージ
     * @param {string} [title='確認'] - モーダルのタイトル（デフォルトは '確認'）
     * @param {string} [icon='help'] - 表示するアイコン（デフォルトは 'help'）
     * @param {boolean} [closeButtonVisible=true] - 閉じるボタンを表示するかどうか（デフォルトは true）
     * @param {boolean} [canCloseOnOverlayClick=true] - オーバーレイクリックで閉じられるかどうか（デフォルトは true）
     * @param {Component} [contentComponent] - モーダル内に表示する動的コンポーネント
     * @param {Record<string, any>} [contentProps={}] - 動的コンポーネントに渡すプロパティ（デフォルトは空オブジェクト）
     * @param {Function} [onConfirm] - 「はい」ボタンクリック時に実行されるコールバック関数
     * @param {Function} [onCancel] - 「いいえ」ボタンクリック時に実行されるコールバック関数
     */
    showConfirm(
        message: string,
        title: string = '確認',
        icon: string = 'help',
        closeButtonVisible: boolean = true,
        canCloseOnOverlayClick: boolean = true,
        contentComponent?: Component,
        contentProps: Record<string, any> = {},
        onConfirm?: () => void,
        onCancel?: () => void
    ) {
        this.message = message;
        this.title = title;
        this.icon = icon;
        this.closeButtonVisible = closeButtonVisible;
        this.canCloseOnOverlayClick = canCloseOnOverlayClick;
        this.contentComponent = contentComponent;
        this.contentProps = contentProps;
        this.onConfirm = onConfirm;
        this.onCancel = onCancel;
        this.isVisible = true;
    },

    /**
     * 確認モーダルを非表示にする
     */
    hideConfirm() {
        this.isVisible = false;  // モーダルを非表示状態に変更
        this.contentComponent = undefined; // コンポーネントをリセット
        this.contentProps = {}; // プロパティもリセット
    }
});
