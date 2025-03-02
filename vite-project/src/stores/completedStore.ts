import { reactive } from 'vue';

/**
 * 完了モーダルの状態を管理するストア
 * 
 * このストアは、完了メッセージを表示・非表示にするための状態とメソッドを提供します。
 * 
 * - `isVisible`: モーダルの表示状態
 * - `message`: 表示するメッセージ
 * - `title`: モーダルのタイトル
 * - `icon`: アイコンの種類
 * - `closeButtonVisible`: 閉じるボタンの表示可否
 * - `canCloseOnOverlayClick`: オーバーレイクリックで閉じるかどうか
 * - `onComplete`: 完了ボタンがクリックされた時のコールバック関数
 * - `showCompleted()`: 完了モーダルを表示するメソッド
 * - `hideCompleted()`: 完了モーダルを非表示にするメソッド
 */

export interface CompletedStore {
    isVisible: boolean;
    message: string;
    title: string;
    icon: string;
    closeButtonVisible: boolean;
    canCloseOnOverlayClick: boolean;
    onComplete?: () => void;
    showCompleted: (
        message: string,
        title?: string,
        icon?: string,
        closeButtonVisible?: boolean,
        canCloseOnOverlayClick?: boolean,
        onComplete?: () => void
    ) => void;
    hideCompleted: () => void;
}

export const completedStore = reactive<CompletedStore>({
    isVisible: false,
    message: '',
    title: '完了',
    icon: 'check_circle',
    closeButtonVisible: false,
    canCloseOnOverlayClick: false,
    onComplete: undefined,

    /**
     * 完了モーダルを表示する
     * 
     * @param {string} message - 表示するメッセージ
     * @param {string} [title='完了'] - モーダルのタイトル（デフォルトは '完了'）
     * @param {string} [icon='check_circle'] - 表示するアイコン（デフォルトは 'check_circle'）
     * @param {boolean} [closeButtonVisible=false] - 閉じるボタンを表示するかどうか（デフォルトは false）
     * @param {boolean} [canCloseOnOverlayClick=false] - オーバーレイクリックで閉じられるかどうか（デフォルトは false）
     * @param {Function} [onComplete] - 完了ボタンクリック時に実行されるコールバック関数
     */
    showCompleted(
        message: string,
        title: string = '完了',
        icon: string = 'check_circle',
        closeButtonVisible: boolean = false,
        canCloseOnOverlayClick: boolean = false,
        onComplete?: () => void
    ) {
        this.message = message;
        this.title = title;
        this.icon = icon;
        this.closeButtonVisible = closeButtonVisible;
        this.canCloseOnOverlayClick = canCloseOnOverlayClick;
        this.onComplete = onComplete;
        this.isVisible = true;
    },

    /**
     * 完了モーダルを非表示にする
     */
    hideCompleted() {
        this.isVisible = false;  // モーダルを非表示状態に変更
    }
});
